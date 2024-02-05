<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;



class Meter extends Model

{

    use HasFactory;



    protected $table = 'meter_data';


    public function customer()

    {

        return $this->belongsTo(Customer::class, 'contract_number', 'cnumber');
    }



    public function assignment()

    {

        return $this->hasOne(AssigmentMeters::class, 'meter_id');
    }



    public function logistics()

    {

        return $this->hasMany(Logistics::class);
    }

    public function readings()

    {

        return $this->hasMany(MeterReading::class, 'meter_id');
    }

    public function user()

    {

        return $this->belongsTo(User::class);
    }

    public function comments()

    {

        return $this->hasMany(MeterAssignmentDeclineComment::class, 'meter_id');
    }


    /**

     * Get the total number of Meters.

     *

     * @return int

     */

    public static function getTotalMeters()

    {

        return self::count();
    }



    /**

     * Get the total number of Assigned Meters.

     *

     * @return int

     */

    public static function getTotalAssignedMeters()

    {

        return self::where('contract_status', 1)->count();
    }



    /**

     * Get the total number of Unassigned Meters.

     *

     * @return int

     */

    public static function getTotalUnassignedMeters()

    {

        return self::where('contract_status', 0)->count();
    }
}
