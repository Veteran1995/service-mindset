<?php

namespace App\Http\Controllers\Admin\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller
{
    public function addTasks()
    {
        return view('admin.Tasks.add-task');
    }

    public function newConnectionTasks()
    {
        return view('admin.Tasks.new-connection-task');
    }
    public function meterReadingTasks()
    {
        return view('admin.Tasks.meter-reading-task');
    }

    public function myTasks()
    {
        return view('admin.Tasks.my-tasks');
    }

    public function meterReadingList()
    {
        return view('admin.Tasks.meter-reading-list');
    }

    public function meterReadingDetail($id)
    {
        return view('admin.Tasks.meter-reading-detail')->with('id', $id);
    }

    public function userMeterReadingItineraries($user_id)

    {
        return view('admin.Tasks.user-meter-reading-itineraries')->with('user_id', $user_id);
    }

    public function serviceOrderTaskReport()
    {
        return view('admin.Tasks.service-order-report-list');
    }

    public function serviceOrderTaskReportDetail($id)
    {
        return view('admin.Tasks.service-order-report-detail')->with('id', $id);
    }

    public function singleTask($task_id)
    {
        return view('admin.Tasks.single-task')->with('task_id', $task_id);
    }

    public function readingTaskDetail($task_id)
    {
        return view('admin.Tasks.meter-reading-task-detail')->with('task_id', $task_id);
    }

    public function editTask($task_id)
    {
        return view('admin.Tasks.edit-task')->with('task_id', $task_id);
    }
}
