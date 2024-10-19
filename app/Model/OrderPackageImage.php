<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackageImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'package_id', 'user_id', 'image'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);//many-to-one
    }

    public function package()
    {
        return $this->belongsTo(OrderPackage::class);//many-to-one
    }

    public function user()
    {
        return $this->belongsTo(User::class);//many-to-one
    }
}
