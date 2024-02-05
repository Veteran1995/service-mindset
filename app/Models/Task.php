<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model

{

    use HasFactory;



    protected $guarded = [];



    public function assignedTo(): BelongsTo

    {

        return $this->belongsTo(User::class, 'assigned_to_id');
    }



    public function crewAssignedTo(): BelongsTo

    {

        return $this->belongsTo(Crew::class, 'crew_id');
    }



    public function comments()

    {

        return $this->hasMany(TaskComment::class, 'task_id');
    }



    public function user(): BelongsTo

    {

        return $this->belongsTo(User::class, 'sender_id');
    }

    public function orderReport(): HasOne

    {

        return $this->hasOne(User::class, 'task_id');
    }



    public function assignedBy(): BelongsTo

    {

        return $this->belongsTo(User::class, 'assigned_by_id');
    }



    public function serviceOrder(): BelongsTo

    {
        return $this->belongsTo(ServiceOrder::class, 'service_order_id');
    }

    public static function getTotalTasks()

    {

        return Task::count();
    }


    public function lossReductionCase()
    {
        return $this->belongsTo(LossReductionCase::class, 'loss_reduction_id');
    }




    public function getTotalUsersAssigned()

    {

        return $this->assignedTo()->count();
    }



    public function getTotalTasksAssignedByUser()

    {

        return Task::where('assigned_by_id', $this->assignedBy)->count();
    }



    public static function getTotalTasksByStatus($status)

    {

        return Task::where('status', $status)->count();
    }
}
