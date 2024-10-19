<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'amount', 'sender_id', 'traveler_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);//many-to-one
    }
}
