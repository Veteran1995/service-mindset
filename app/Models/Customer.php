<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Customer extends Model

{

    use HasFactory;


    protected $guarded = [];
    protected $table = 'customers';

    protected $primaryKey = 'cnumber';

    public $incrementing = false;


    public function meters()

    {
        return $this->hasMany(MeterData::class, 'contract_number', 'cnumber');
    }

    public function location()

    {
        return $this->hasOne(CustomerLocation::class, 'cnumber', 'cnumber');
    }

    public function serviceOrders()

    {

        return $this->hasMany(ServiceOrderData::class, 'cnumber', 'cnumber');
    }



    /**

     * Get the total number of users.

     *

     * @return int

     */

    public static function getTotalCustomers()

    {

        return self::count();
    }



    /**

     * Get the total number of admin users.

     *

     * @return int

     */

    public static function getTotalMaleCustomer()

    {

        return self::where('gender', 'Male')->count();
    }





    /**

     * Get the total number of admin users.

     *

     * @return int

     */

    public static function getTotalFeMaleCustomer()

    {

        return self::where('gender', 'Female')->count();
    }





    /**

     * Get the total number of active users.

     *

     * @return int

     */

    public static function getTotalActiveCustomers()

    {

        return self::where('contract_status', 1)->count();
    }



    /**

     * Get the total number of inactive users.

     *

     * @return int

     */

    public static function getTotalInactiveCustomers()

    {

        return self::where('status', 0)->count();
    }
}
