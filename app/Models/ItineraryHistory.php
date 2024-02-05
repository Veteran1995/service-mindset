<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryHistory extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'itinerary_histories';

    public function itinerary()
    {
        return $this->belongsTo(MeterAssignment::class, 'itinerary_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
