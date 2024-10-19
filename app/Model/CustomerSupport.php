<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    use HasFactory;


    protected $fillable = [
        'subject',
        'description',
        'order_id',
        'user_id',
        'message',
        'type',
        'seen',
        'image',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'support_id');
    }
}
