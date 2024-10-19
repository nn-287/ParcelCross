<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id', 'reviewer_user_id', 'reviewed_user_id', 'rating', 'comment'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);//many-to-one
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_user_id');//many-to-one
    }

    public function reviewedUser()
    {
        return $this->belongsTo(User::class, 'reviewed_user_id');//many-to-one
    }
}
