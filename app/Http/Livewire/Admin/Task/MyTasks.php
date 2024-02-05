<?php

namespace App\Http\Livewire\Admin\Task;

use Carbon\Carbon;

use App\Models\Meter;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyTasks extends Component
{
    public $users;
    public $meters;

    public $task;
    public $comment;

    // public $taskComments;

    public $totalOpenTasks;
    public $totalClosedTasks;
    public $totalCompletedTasks;

    public $searchByDate;
    public $searchByName;

    public $myCrewTasks;

    public $state = [
        'task_name' => '',
        'description' => '',
        'assign_date' => '',
        'due_date' => '',
        'meter' => '',
        'priority' => '',
        'assignee' => '',
    ];

    protected $rules = [
        'comment' => 'required',
        // Add other validation rules if needed
    ];

    public function addTaskComment($task)
    {
        $this->task = $task;
        // $this->taskComments = TaskComment::where('task_id', $this->task)->get();
        $this->dispatchBrowserEvent('openTaskCommentModal');
    }

    public function addComment()
    {
        $validatedData = $this->validate();

        TaskComment::create([
            'comment' => $validatedData['comment'],
            'sender_id' => auth()->user()->employee_id,
            'task_id' => $this->task,
        ]);

        // Reset the form field
        $this->reset('comment');

        $this->dispatchBrowserEvent('closeTaskCommentModal');

        // Show success message or perform any additional actions
        $this->dispatchBrowserEvent('success', ['message' => 'Comment Added Successfully']);
    }

    public function addTask()
    {

        $validatedData = $this->validate([
            'state.task_name' => 'required',
            'state.description' => 'required',
            'state.assign_date' => 'required',
            'state.due_date' => 'required',
            'state.meter' => 'required',
            'state.priority' => 'required',
            'state.assignee' => 'required',
        ]);

        // Create the task record
        Task::create([
            'name' => $validatedData['state']['task_name'],
            'description' => $validatedData['state']['description'],
            'assign_date' => $validatedData['state']['assign_date'],
            'due_date' => $validatedData['state']['due_date'],
            'meter_id' => $validatedData['state']['meter'],
            'priority' => $validatedData['state']['priority'],
            'assigned_to_id' => $validatedData['state']['assignee'],
            'assigned_by_id' => Auth::user()->employee_id,
        ]);

        // Clear form fields
        $this->state = [
            'task_name' => '',
            'description' => '',
            'assign_date' => '',
            'due_date' => '',
            'meter' => '',
            'priority' => '',
            'assignee' => '',
        ];

        // Show success message or perform any additional actions
        $this->dispatchBrowserEvent('success', ['message' => 'Task Added and Assigned Successfully']);
    }

    public function mount()
    {

        $this->totalOpenTasks = Task::where('assigned_to_id', Auth::user()->employee_id)
            ->where('status', 'Open')->count();
        $this->totalClosedTasks = Task::where('assigned_to_id', Auth::user()->employee_id)
            ->where('status', 'Close')->count();
        $this->totalCompletedTasks = Task::where('assigned_to_id', Auth::user()->employee_id)
            ->where('status', 'Completed')->count();

        // $this->myCrews = Auth::user()->member->crew;
        if (Auth::user()->member && Auth::user()->member->crew->task) {
            $this->myCrewTasks = Auth::user()->member->crew->task;
        } else {
            $this->myCrewTasks == NULL;
        }
    }

    // Fetching All Records and Adding Search and Filters
    public function getTasksProperty()
    {
        return Task::select('*')
            ->where('name', 'like', '%' . $this->searchByName . '%')
            ->where('created_at', 'like', '%' . $this->searchByDate . '%')
            ->where('assigned_to_id', Auth::user()->employee_id)
            ->latest()->paginate(6);
    }

    public function render()
    {
        $this->users = User::all();
        $this->meters = Meter::all();
        $tasks =  $this->tasks;

        return view('livewire.admin.task.my-tasks', ['meters' => $this->meters, 'users' => $this->users, 'tasks' => $tasks]);
    }
}
