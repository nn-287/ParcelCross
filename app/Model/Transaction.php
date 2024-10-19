<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'user_id', 'bank_account_id', 'date', 'description', 'status'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];
}
