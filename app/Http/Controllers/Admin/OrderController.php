<?php

namespace App\Http\Controllers\Admin;

use App\Actions\OrderActions;
use App\Http\Controllers\Controller;
use App\Jobs\SendOrderUpdate;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $pending = Order::where('status', 1)->get();
        return view('admin.orders.index', compact('orders', 'pending'));
    }

    public function show($id)
    {
        $order = Order::where('order_reference', '=', $id)->first();
        // dd($order->order_currency);
        $currency = Currency::where('code', '=', $order->order_currency)->first();
        return view('admin.orders.show', compact('order', 'currency'));
    }

    public function update(Request $request, $id)
    {
        try {
            if ($request->status == 2) {
                $newOrder = Order::findOrFail($id);
                $user = $newOrder->shipping_email;
                $res = OrderActions::update($request, $id);
                $status = "Your order has been completed and is ready for shipping! We'll notify you once the order has been shipped. ";
                if ($res) {
                    // SendOrderUpdate::dispatch($newOrder, $user, $status)->delay(now()->addMinutes(3));
                    return back()->with('success', 'Updated successfully!');
                }
            } else if ($request->status == 4) {
                $newOrder = Order::findOrFail($id);
                $user = $newOrder->shipping_email;
                $res = OrderActions::update($request, $id);
                $status = "Your order has been shipped and is on its way to you!";
                if ($res) {
                    // SendOrderUpdate::dispatch($newOrder, $user, $status)->delay(now()->addMinutes(3));
                    return back()->with('success', 'Updated successfully!');
                }
            } else if ($request->status == 5) {
                $newOrder = Order::findOrFail($id);
                // dd($newOrder);
                $user = $newOrder->shipping_email;
                $res = OrderActions::update($request, $id);
                $status = "Thank you for shopping with Simss & Stitches. Your order has been delivered. We look forward to you shopping with us again soon.";
                if ($res) {
                    try {
                        // SendOrderUpdate::dispatch($newOrder, $user, $status)->delay(now()->addMinutes(3));
                        return back()->with('success', 'Updated successfully!');
                    } catch (\Exception $e) {
                        return back()->with('error', $e->getMessage());
                    }
                }
            } else {
                $res = OrderActions::update($request, $id);
                if ($res) {
                    return back()->with('success', 'Updated successfully');
                } else {
                    return back()->with('error', 'An error occured');
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMEssage());
        }
    }
}
