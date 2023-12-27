<?php

namespace App\Http\Controllers;

use Paystack;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Currency;
use App\Models\Shipping;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Actions\OrderActions;
use App\Jobs\SendOrderInvoice;
use App\Services\OrderQueries;
use App\Models\CouponRedemption;
use App\Actions\VerifyTransaction;
use Illuminate\Support\Facades\DB;
use App\Jobs\AdminOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cartItems = \Cart::session(Helper::getSessionID())->getContent();
        $cartTotalQuantity = \Cart::session(Helper::getSessionID())->getContent()->count();
        $order_details = session('order');
        $address = Address::where('user_id', auth()->id())->where('default', true)->first();

        if ($cartItems->count() > 0) {
            return view('checkout.page-1', compact('cartItems', 'cartTotalQuantity', 'order_details', 'address'));
        } else {
            return redirect()->route('shop');
        }
    }



    public function contactInformation(Request $request)
    {
        // dd($request->all());
        try {
            if (empty($request->session()->get('order'))) {
                $order = new Order;
                $order->fill($request->except('_token'));
                $request->session()->put('order', $order);
                $session = session('session');
            } else {
                $order = $request->session()->get('order');
                $session = $request->session()->get('session');
                $order->fill($request->except('_token'));
                $request->session()->put('order', $order);
            }
            // dd(session('order'));
            return redirect()->route('checkout.page-2', ['session' => $session]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function applyCoupon(Request $request){
        try {
            $coupon = Coupon::where('name',$request->coupon_code)->first();
            if($coupon){
                $order_details = session('order');
                if(Auth::user()){
                    $email = Auth::user()->email;
                    $rowcount = CouponRedemption::where('redeemer_id',$email)->count();
                    if($rowcount > $coupon->maximum_usage){
                        return response()->json([
                            'success' => false,
                            'message' => 'You already used this coupon',
                        ], 400);
                    }else if($coupon->ends_at < Carbon::now()){
                        return response()->json([
                            'success' => false,
                            'message' => 'This coupon has expired',
                        ], 400);
                    }else{
                        $coupon_redemption = new CouponRedemption;
                        $coupon_redemption->redeemer_id = $email;
                        $coupon_redemption->coupon_id = $coupon->id;
                        $coupon_redemption->save();

                        $condition = new \Darryldecode\Cart\CartCondition(array(
                            'name' => 'Discount',
                            'type' => 'discount',
                            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                            'value' => '-'.$coupon->value.'%',
                        ));
                        \Cart::session(Helper::getSessionID())->condition($condition);
                        $conditionValue = $condition->getValue();
                    }
                    // Add
                    return response()->json([
                        'message' => 'success',
                        'conditionValue' => $conditionValue,
                    ], 200);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'You need to log in to redeem a coupon',
                    ], 401);
                }
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon not found',
                ], 404);
            }
            // check if user has used coupon
        } catch (\Exception $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function shipping(Request $request)
    {
        try {
            $order = $request->session()->get('order');
            $session = $request->session()->get('session');
            $cartItems = \Cart::session(Helper::getSessionID())->getContent();
            $shippings = Shipping::all();
            // set default
            $location = Shipping::first();
            return view('checkout.page-2', compact('order', 'cartItems', 'session', 'shippings'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function setShipping(Request $request)
    {
        $location = Shipping::findOrFail($request->id);
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'Express Shipping',
            'type' => 'shipping',
            'target' => 'total',
            'value' => '+' . $location->price,
            'attributes' => array(
                'id' => $location->id,
            ),
        ));
        \Cart::session(Helper::getSessionID())->condition($condition);
        $conditionValue = $condition->getValue();

        return response()->json([
            'message' => 'success',
            'conditionValue' => $conditionValue,
        ], 200);
    }

    public function postShipping(Request $request)
    {
        try {
            $order = $request->session()->get('order');
            $session = $request->session()->get('session');
            $order->fill($request->all());
            $request->session()->put('order', $order);
            return redirect()->route('checkout.page-3', ['session' => $session]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showPayment(Request $request)
    {
        try {
            $order = $request->session()->get('order');
            $session = $request->session()->get('session');
            $cartItems = \Cart::session(Helper::getSessionID())->getContent();
            $condition = \Cart::getCondition('Express Shipping');
            $attribute = $condition->getAttributes(); // the name of the condition
            $location = Shipping::findOrFail($attribute['id']); // the value of the condition
            // dd(session()->get('order'));
            return view('checkout.page-3', compact('order', 'cartItems', 'location', 'session'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getPaymentMethod(Request $request)
    {
        $currency = session('currency_code') ?? session('system_default_currency_info')->code;
        $order = $request->session()->get('order');
        $reference = Paystack::genTranxRef();
        $amount = Helper::currency_converter(\Cart::session(Helper::getSessionID())->getTotal());
        $email = $order->shipping_email;
        $metadata = [
            'order' => $request->session()->get('order'),
            'cart' => \Cart::session(Helper::getSessionID())->getContent(),
            'subamount' => \Cart::session(Helper::getSessionID())->getSubTotal(),
        ];
        $request->merge(['metadata' => $metadata, 'reference' => $reference, 'currency' => $currency, 'amount' => (int) ($amount * 100), 'email' => $email]);
        return $this->getRedirectUrl($request);
    }

    /**
     * Paystack Payment functions
     *
     * @return void
     */
    public function getRedirectUrl($request)
    {
        // dd($request->all());
        try {
            $res = Http::withToken(config('paystack.secretKey'))->post('https://api.paystack.co/transaction/initialize', [
                'metadata' => json_encode($request->metadata),
                'reference' => Str::random(17),
                'currency' => $request->currency,
                'amount' => $request->amount,
                'email' => $request->email,
                'callback_url' => 'https://simssandstitches.com/payment/callback',
            ]);

            $result = $res->collect();
            // dd($result);
            if ($result['status'] == true && $result['data']['authorization_url']) {
                return redirect()->away($result['data']['authorization_url']);
            } else {
                throw new Exception($result['message']);
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function paystackHandleGatewayCallback(Request $request)
    {
        $paymentDetails = (new VerifyTransaction())->run($request->query('trxref'));
        $order = $paymentDetails['data']['metadata']['order'];
        $amount = $paymentDetails['data']['amount'] / 100;
        $subamount = $paymentDetails['data']['metadata']['subamount'];
        $user_id = auth()->check() ? auth()->id() : rand(0000, 9999);
        $method = "paystack";
        $currency = Currency::where('code', $paymentDetails['data']['currency'])->first();
        $cart = $paymentDetails['data']['metadata']['cart'];
        $reference = $paymentDetails['data']['reference'];
        if ($paymentDetails['status']) {
            $res = OrderActions::store($reference, $order, $amount, $subamount, $user_id, $method, $currency, $cart);
            $newOrder = OrderQueries::findByRef($res);

            DB::beginTransaction();
            if (Payment::where('payment_ref', $paymentDetails['data']['reference'])->first()) {
                throw new Exception('Duplicate transaction');
            } else {
                $payment = new Payment();
                $payment->user_id = $newOrder->user_id;
                $payment->order_id = $newOrder->id;
                $payment->amount = $amount;
                $payment->currency = $newOrder->order_currency;
                $payment->description = 'Payment for Order ' . $newOrder->order_number;
                $payment->payment_ref = $paymentDetails['data']['id'];
                $payment->save();
                DB::commit();

                $admin = User::where('is_admin', 1)->get();
                $user = $newOrder->shipping_email;

                \Cart::session(Helper::getSessionID())->clear();
                \Cart::session(Helper::getSessionID())->clearCartConditions();
                request()->session()->forget('order');
                request()->session()->forget('session');

//                AdminOrderNotification::dispatch($newOrder, $admin);
//                SendOrderInvoice::dispatch($newOrder, $user)->delay(now()->addMinutes(3));

                return redirect()->route('checkout.success', ['reference' => $newOrder->order_reference]);
            }
        }

    }

    public function checkoutSuccessful($ref)
    {
        try {
            $order = OrderQueries::findByRef($ref);
            $currency = Currency::where('code', $order->order_currency)->first();
            // /
            if ($order) {
                return view('shop.order-success', compact('order', 'currency'));
            } else {
                abort(404);
            }
        } catch (\Exception $th) {
            return $th->getMessage();
        }

    }
}
