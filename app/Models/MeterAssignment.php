<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class MeterAssignment extends Model

{

    protected $guarded = [];

    use HasFactory;



    public function user()

    {

        return $this->belongsTo(User::class, 'user_id', 'employee_id');
    }


    public function readings()

    {

        return $this->hasMany(MeterReading::class, 'assign_id');
    }

    public function comments()

    {

        return $this->hasMany(ItineraryComment::class, 'itinerary_id');
    }



    public function meters()

    {

        return $this->hasMany(AssigmentMeters::class, 'assign_id');
    }

    public function histories()
    {
        return $this->hasMany(ItineraryHistory::class, 'itinerary_id');
    }
}
