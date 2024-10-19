<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\User;

class FlightDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'departure_country',
        'departure_city',
        'destination_country',
        'destination_city',
        'departure_time',
        'arrival_time',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
