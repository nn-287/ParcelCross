<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_id', 'traveler_id', 'pickup_latitude', 'pickup_longitude',
        'traveler_latitude', 'traveler_longitude', 'fees', 'commission_fees',
        'customer_tips', 'order_scope', 'delivery_date', 'order_status',
        'sender_verified', 'receiver_verified', 'payment_method', 'payment_status','origin_country','origin_city','destination_country','destination_city','recipient_info'
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
    ];

    public function packages()
    {
        return $this->hasMany(OrderPackage::class);//one-to-many
    }

    public function images()
    {
        return $this->hasMany(OrderPackageImage::class);//one-to-many
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function traveler()
    {
        return $this->belongsTo(User::class, 'traveler_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);// one-to-many
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);//one-to-many
    }

    public function disputes()
    {
        return $this->hasMany(Dispute::class);//one-to-many 
    }

    
}
