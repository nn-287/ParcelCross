<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class PremiumSubscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id', 'user_id', 'amount'
    ];

    public function plan()
    {
        return $this->belongsTo(PremiumPlan::class);//many-to-one
    }

    public function user()
    {
        return $this->belongsTo(User::class);//many-to-one
    }
}
