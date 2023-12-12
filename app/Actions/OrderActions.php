<?php
namespace App\Actions;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Str;

class OrderActions
{
    public static function store($ref, $order, $amount, $subamount, $user_id = null, $method, $currency, $cart = null)
    {
        // dd($order);
        $newOrder = new Order();
        $newOrder->user_id = $user_id;
        $newOrder->order_number = uniqid('#');
        $newOrder->order_reference = $ref ?? Str::random(20);
        $newOrder->status = 1;
        $newOrder->subtotal = floatval($subamount) * $currency->exchange_rate;
        $newOrder->grand_total = $amount;
        $newOrder->order_currency = $currency->code;
        $newOrder->is_paid = 1;

        $newOrder->item_count = count($cart);
        $newOrder->payment_method = $method;
        $newOrder->shipping_email = $order['shipping_email'];
        $newOrder->shipping_fname = $order['shipping_fname'];
        $newOrder->shipping_lname = $order['shipping_lname'];
        $newOrder->shipping_address = $order['shipping_address'];
        $newOrder->shipping_city = $order['shipping_city'];
        $newOrder->shipping_state = $order['shipping_state'];
        $newOrder->shipping_phone = $order['shipping_phone'];
        $newOrder->shipping_postal_code = $order['shipping_postal_code'];
        $newOrder->shipping_country = $order['shipping_country'];
        // $cartItems =  \Cart::session(Helper::getSessionID())->getContent();
        $newOrder->save();
        // dd($cart);
        foreach ($cart as $item) {
            $newOrder->items()->attach($item['id'], ['price' => floatval($item['price'] * $currency->exchange_rate), 'quantity' => $item['quantity'], 'product_attributes' => json_encode($item['attributes'])]);
        }

        $user_address = Address::where([
            ['user_id', '=', $user_id],
        ])->first();

        if (!$user_address) {
            $address = new Address();
            $address->user_id = $user_id;
            $address->default = true;
            $address->shipping_fname = $order['shipping_fname'];
            $address->shipping_lname = $order['shipping_lname'];
            $address->shipping_address = $order['shipping_address'];
            $address->shipping_country = $order['shipping_country'];
            $address->shipping_city = $order['shipping_city'];
            $address->shipping_state = $order['shipping_state'];
            $address->shipping_zipcode = $order['shipping_postal_code'];
            $address->shipping_phone = $order['shipping_phone'];
            $address->save();
        }

        return $ref;
    }

    public static function update($request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->update();
        return true;
    }

}
