<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Meter;
use App\Models\Task;
use App\Models\Crew;
use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tasks extends Component
{
    public $users;
    public $meters;

    public $totalTasks;
    public $totalUsersAssigned;
    public $totalTasksAssignedByUser;
    public $totalOpenTasks;
    public $totalClosedTasks;
    public $totalCompletedTasks;

    public $searchByDate;
    public $searchByName;

    public $state = [
        'task_name' => '',
        'description' => '',
        'assign_date' => '',
        'due_date' => '',
        'service_order_id' => '',
        'priority' => '',
        'individual' => '',
        'crew' => '',
    ];

    public $edit = [];

    public function addTask()
    {

        $validatedData = $this->validate([
            'state.task_name' => 'required',
            'state.description' => 'required',
            'state.assign_date' => 'required',
            'state.due_date' => 'required',
            'state.service_order_id' => 'required',
            'state.priority' => 'required',
        ]);

        $checkServiceOrder = Task::where('service_order_id', $validatedData['state']['service_order_id'])->get();
        if ($checkServiceOrder->count() > 0) {
            $this->dispatchBrowserEvent('warning', ['message' => 'This Task is Already Assigned to Another Person or Crew']);
            return;
        }

        if (array_key_exists('crew', $this->state)) {
            if ($this->state['crew'] != "") {
                // Create the task record
                Task::create([
                    'name' => $validatedData['state']['task_name'],
                    'description' => $validatedData['state']['description'],
                    'assign_date' => $validatedData['state']['assign_date'],
                    'due_date' => $validatedData['state']['due_date'],
                    'service_order_id' => $validatedData['state']['service_order_id'],
                    'priority' => $validatedData['state']['priority'],
                    'crew_id' => $this->state['crew'],
                    'assigned_by_id' => Auth::user()->employee_id,
                ]);
                // Clear form fields
                $this->state = [
                    'task_name' => '',
                    'description' => '',
                    'assign_date' => '',
                    'due_date' => '',
                    'service_order_id' => '',
                    'priority' => '',
                    'assignee' => '',
                ];
                $this->dispatchBrowserEvent('success', ['message' => 'Task Created and Assigned Successfully']);
                return;
            }
        }

        if (array_key_exists('individual', $this->state)) {
            if ($this->state['individual'] != "") {
                // Create the task record
                Task::create([
                    'name' => $validatedData['state']['task_name'],
                    'description' => $validatedData['state']['description'],
                    'assign_date' => $validatedData['state']['assign_date'],
                    'due_date' => $validatedData['state']['due_date'],
                    'service_order_id' => $validatedData['state']['service_order_id'],
                    'priority' => $validatedData['state']['priority'],
                    'assigned_to_id' => $this->state['individual'],
                    'assigned_by_id' => Auth::user()->employee_id,
                ]);
                // Clear form fields
                $this->state = [
                    'task_name' => '',
                    'description' => '',
                    'assign_date' => '',
                    'due_date' => '',
                    'service_order_id' => '',
                    'priority' => '',
                    'assignee' => '',
                ];
                $this->dispatchBrowserEvent('success', ['message' => 'Task Created and Assigned Successfully']);
                return;
            }
        }

        if ($this->state['individual'] == "" && $this->state['crew'] == "") {

            $this->dispatchBrowserEvent('warning', ['message' => 'Please Select an Individual or Crew to Assign Task']);
        }
    }

    // public function showEditTaskModal(Crew $id)
    // {
    //     $this->edit['task_name']=$id->name;
    //     $this->edit['task_name']=$id->name;
    //     $this->edit['task_name']=$id->name;
    //     $this->edit['task_name']=$id->name;
    //     $this->edit['task_name']=$id->name;

    //     $this->dispatchBrowserEvent('openEditTaskModal');
    // }

    // public function editTask()
    // {

    //     $validatedData = $this->validate([
    //         'state.task_name' => 'required',
    //         'state.description' => 'required',
    //         'state.assign_date' => 'required',
    //         'state.due_date' => 'required',
    //         'state.service_order_id' => 'required',
    //         'state.priority' => 'required',
    //     ]);

    //     $checkServiceOrder = Task::where('service_order_id', $validatedData['state']['service_order_id'])->get();
    //     if ($checkServiceOrder->count() > 0) {
    //         $this->dispatchBrowserEvent('warning', ['message' => 'This Task is Already Assigned to Another Person or Crew']);
    //         return;
    //     }

    //     if (array_key_exists('crew', $this->state)) {
    //         if ($this->state['crew'] != "") {
    //             // Create the task record
    //             Task::create([
    //                 'name' => $validatedData['state']['task_name'],
    //                 'description' => $validatedData['state']['description'],
    //                 'assign_date' => $validatedData['state']['assign_date'],
    //                 'due_date' => $validatedData['state']['due_date'],
    //                 'service_order_id' => $validatedData['state']['service_order_id'],
    //                 'priority' => $validatedData['state']['priority'],
    //                 'crew_id' => $this->state['crew'],
    //                 'assigned_by_id' => Auth::user()->employee_id,
    //             ]);
    //             // Clear form fields
    //             $this->state = [
    //                 'task_name' => '',
    //                 'description' => '',
    //                 'assign_date' => '',
    //                 'due_date' => '',
    //                 'service_order_id' => '',
    //                 'priority' => '',
    //                 'assignee' => '',
    //             ];
    //             $this->dispatchBrowserEvent('success', ['message' => 'Task Created and Assigned Successfully']);
    //             return;
    //         }
    //     }

    //     if (array_key_exists('individual', $this->state)) {
    //         if ($this->state['individual'] != "") {
    //             // Create the task record
    //             Task::create([
    //                 'name' => $validatedData['state']['task_name'],
    //                 'description' => $validatedData['state']['description'],
    //                 'assign_date' => $validatedData['state']['assign_date'],
    //                 'due_date' => $validatedData['state']['due_date'],
    //                 'service_order_id' => $validatedData['state']['service_order_id'],
    //                 'priority' => $validatedData['state']['priority'],
    //                 'assigned_to_id' => $this->state['individual'],
    //                 'assigned_by_id' => Auth::user()->employee_id,
    //             ]);
    //             // Clear form fields
    //             $this->state = [
    //                 'task_name' => '',
    //                 'description' => '',
    //                 'assign_date' => '',
    //                 'due_date' => '',
    //                 'service_order_id' => '',
    //                 'priority' => '',
    //                 'assignee' => '',
    //             ];
    //             $this->dispatchBrowserEvent('success', ['message' => 'Task Created and Assigned Successfully']);
    //             return;
    //         }
    //     }

    //     if ($this->state['individual'] == "" && $this->state['crew'] == "") {

    //         $this->dispatchBrowserEvent('warning', ['message' => 'Please Select an Individual or Crew to Assign Task']);
    //     }
    // }

    public function mount()
    {
        // Calling the static function getTotalTasks()
        $this->totalTasks = Task::getTotalTasks();

        // Creating an instance of Task
        $task = new Task();

        // Calling the non-static functions on an instance of Task
        $this->totalUsersAssigned = $task->getTotalUsersAssigned();
        $this->totalTasksAssignedByUser = $task->getTotalTasksAssignedByUser();
        $this->totalOpenTasks = Task::getTotalTasksByStatus('open');
        $this->totalClosedTasks = Task::getTotalTasksByStatus('close');
        $this->totalCompletedTasks = Task::getTotalTasksByStatus('completed');
    }

    // Fetching All Records and Adding Search and Filters
    public function getTasksProperty()
    {
        return Task::select('*')
            ->where('name', 'like', '%' . $this->searchByName . '%')
            ->where('created_at', 'like', '%' . $this->searchByDate . '%')
            ->latest()->paginate(6);
    }

    public function render()
    {
        $this->users = User::all();
        $orders = ServiceOrder::all();
        $tasks =  $this->tasks;
        $crews = Crew::all();

        return view('livewire.admin.task.tasks', ['orders' => $orders, 'users' => $this->users, 'tasks' => $tasks, 'crews' => $crews]);
    }
}
