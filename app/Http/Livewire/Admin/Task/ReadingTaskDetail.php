<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Customer;
use App\Models\Meter;
use App\Models\MeterAssignment;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ReadingTaskDetail extends Component
{
    use WithPagination;

    public $meter;
    public $task;
    public $state = [];
    public $isCreating = false;

    public $address;
    public $lat;
    public $long;
    public $latitude;
    public $longitude;
    public $location;

    public $comment;

    public $latit;
    public $longit;

    public $taskComments;

    public $photo;

    public function showAllCommets()
    {
        $this->dispatchBrowserEvent('openTaskCommentModal');
    }

    public function addComment()
    {
        if ($this->comment <> "") {
            TaskComment::create([
                'comment' => $this->comment,
                'sender_id' => auth()->user()->employee_id,
                'task_id' => $this->task->id,
            ]);

            // Reset the form field
            $this->reset('comment');

            $this->dispatchBrowserEvent('closeTaskCommentModal');

            // Show success message or perform any additional actions
            $this->dispatchBrowserEvent('success', ['message' => 'Comment Added Successfully']);
            $this->mount($this->task);
        } else {
            $this->dispatchBrowserEvent('toastWarning', ['message' => 'Comment Field is Required']);
        }
    }



    public function mount(MeterAssignment $task_id)
    {
        $this->task = $task_id;
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.admin.task.reading-task-detail', ['users' => $users]);
    }
}
