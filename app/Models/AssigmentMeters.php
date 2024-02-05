<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class AssigmentMeters extends Model

{

    protected $guarded = [];

    use HasFactory;



    public function assignment()

    {
        return $this->belongsTo(MeterAssignment::class);
    }


    public function meter()

    {

        return $this->belongsTo(Meter::class, 'meter_id');
    }
}
