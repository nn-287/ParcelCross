<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Dispute extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'complainer_user_id', 'defendant_user_id', 'complainer_reason',
        'defendant_reason', 'complaint_status'
    ];


    // Disable timestamps for this model
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class);//many-to-one
    }

    public function complainer()
    {
        return $this->belongsTo(User::class, 'complainer_user_id');//many-to-one
    }

    public function defendant()
    {
        return $this->belongsTo(User::class, 'defendant_user_id');//many-to-one
    }
}
