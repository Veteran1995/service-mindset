<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class MeterReading extends Model

{

    protected $guarded = [];

    use HasFactory;



    public function assignment()

    {

        return $this->belongsTo(MeterAssignment::class, 'assign_id');
    }

    public function meter()

    {

        return $this->belongsTo(Meter::class, 'meter_id');
    }
}
