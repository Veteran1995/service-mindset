<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskRejectionReason extends Model
{
    protected $guarded = [];
    protected $table = 'task_rejection_reasons'; // Replace with your actual table name

    use HasFactory;
}
