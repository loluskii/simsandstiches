<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponRedemption extends Model
{
    use HasFactory;
    protected $fillable = [
        'redeemer_id', // user id who redeems the voucher
        'coupon_id', // voucher
        'item_id', // product item
    ];
}
