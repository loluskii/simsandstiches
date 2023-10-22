<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function getFullName()
    {
        if($this->fname != null){
            return $this->fname.' '.$this->lname;
        }else{
            return null;
        }
    }

    public function getDefaultAddress(){
        $address = Address::where('user_id',$this->id)->where('default',true)->first();
        if($address){
            return $address;
        }else{
            return null;
        }
    }

    public function getCountry(){
        $address = Address::where('user_id',$this->id)->where('default',true)->first();
        if($address){
            return $address->shipping_state.', '.$address->shipping_country;
        }else{
            return null;
        }
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function getOrders(){
        return Order::where('user_id', $this->id)->get();
    }
}
