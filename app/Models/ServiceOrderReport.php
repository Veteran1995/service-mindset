<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrderReport extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function logistics()
    {
        return $this->hasMany(Logistic::class, 'task_report_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
