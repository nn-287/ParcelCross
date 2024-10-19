<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'user_id',
        'message',
        'type',
        'seen',
        'image',
        'support_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customerSupport()
    {
        return $this->belongsTo(CustomerSupport::class, 'support_id');
    }
}
