<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Model\Order;
use App\Model\FlightDetail;
use App\Model\Message;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory;

    protected $fillable = [
        'f_name', 'l_name', 'phone', 'email', 'password', 'cm_firebase_token',
        'remember_token', 'image', 'luggage_space', 'user_type', 'latitude',
        'longitude', 'identity_number', 'identity_image', 'premium_membership_id','provider_name','provider_id'
    ];



    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'sender_id');
    }

    // public function premiumSubscription()
    // {
    //     return $this->hasOne(PremiumSubscription::class);
    // }


    public function flightDetail(): HasOne
    {
        return $this->hasOne(FlightDetail::class);
    }



    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
