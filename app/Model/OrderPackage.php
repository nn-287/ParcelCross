<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'title', 'description', 'size', 'weight', 'quantity', 'is_fragile','image'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);// many-to-one
    }
}
