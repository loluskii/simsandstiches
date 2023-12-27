<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'type',
        'value', // percentage of discount
        'maximum_usage', // maximum usage per user. If it's 1, it means user only can use it once.
        'starts_at', // additional terms
        'ends_at',
        'is_active', // for exception if we want to deactivate the voucher (although voucher is valid)
     ];
}
