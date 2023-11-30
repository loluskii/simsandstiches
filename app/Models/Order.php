<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipping_fname',
        'shipping_lname' ,
        'shipping_email',
        'shipping_address'  ,
        'shipping_city' ,
        'shipping_state' ,
        'shipping_country',
        'shipping_phone' ,
        'shipping_landmark' ,
        'shipping_postal_code',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_items','order_id','product_id')->withPivot('quantity','price','size','color');
    }

    public function pending()
    {
        return $this->where('status',1)->get();
    }

    // public function currency(){
    //     $order = Currency::where('code','=',$this->order_currency)->first();
    //     return $order->code;
    //     // return $this->belongsTo(Currency::class, 'order_currency');
    // }
}
