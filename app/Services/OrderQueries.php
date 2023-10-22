<?php

namespace App\Services;

use DB;
use Exception;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class OrderQueries{

    public static function findByRef($ref){
        return Order::firstWhere('order_reference', $ref);
    }
    public function getUserOrderDetails($id){
        $orders = DB::table('orders')->where('user_id', $id)->pluck('id');
        return $orders;
    }

    // public static function getMonthlyRevenue(){
    //     return Order::whereBetween('created_at',[Carbon::now()->startOfMonth(), Carbon::now()])->sum('subtotal');
    // }

    public static function getPendingOrders(){
        return Order::whereNotIn('status',[5,6])->get();
    }

    public static function getMonthlyRevenuePounds(){
        return Order::whereBetween('created_at',[Carbon::now()->startOfMonth(), Carbon::now()])
                        ->where('order_currency','GBP')
                        ->sum('subtotal');
    }

    public static function getMonthlyRevenueDollars(){
        return Order::whereBetween('created_at',[Carbon::now()->startOfMonth(), Carbon::now()])
                        ->where('order_currency','USD')
                        ->sum('subtotal');
    }

    public static function getMonthlyRevenueNaira(){
        return Order::whereBetween('created_at',[Carbon::now()->startOfMonth(), Carbon::now()])
                        ->where('order_currency','NGN')
                        ->sum('subtotal');
    }



}

?>
