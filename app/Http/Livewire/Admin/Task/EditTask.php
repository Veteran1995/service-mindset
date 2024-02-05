<?php

namespace App\Http\Livewire\Admin\Task;

use App\Models\Meter;
use App\Models\Task;
use App\Models\Crew;
use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditTask extends Component
{
    public $edit = [];
    public $task;

    public function mount(Task $task_id)
    {
        $this->task = $task_id;
        $this->edit = $this->task->toArray();
    }


    public function editTask()
    {

        if (isset($this->edit['assigned_to_id']) && !empty($this->edit['assigned_to_id'])) {
            $validatedData = $this->validate([
                'edit.name' => 'required',
                'edit.description' => 'required',
                'edit.due_date' => 'required',
                'edit.service_order_id' => Rule::unique('tasks', 'service_order_id')->ignore($this->task->id),
                'edit.assigned_to_id' => Rule::unique('tasks', 'assigned_to_id')->ignore($this->task->id),
                'edit.priority' => 'required',
            ]);
        } elseif (isset($this->edit['crew_id']) && !empty($this->edit['crew_id'])) {
            $validatedData = $this->validate([
                'edit.name' => 'required',
                'edit.description' => 'required',
                'edit.due_date' => 'required',
                'edit.service_order_id' => Rule::unique('tasks', 'service_order_id')->ignore($this->task->id),
                'edit.crew_id' => Rule::unique('tasks', 'crew_id')->ignore($this->task->id),
                'edit.priority' => 'required',
            ]);
        }

        // Rest of your code

        // Load the task to be updated
        $task = $this->task;

        // Update the task attributes with the new values
        $task->name = $this->edit['name'];
        $task->description = $this->edit['description'];
        $task->due_date = $this->edit['due_date'];
        $task->service_order_id = $this->edit['service_order_id'];
        if (isset($this->edit['assigned_to_id']) && !empty($this->edit['assigned_to_id'])) {
            $task->assigned_to_id = $this->edit['assigned_to_id'];
        } elseif (isset($this->edit['crew_id']) && !empty($this->edit['crew_id'])) {
            $task->crew_id = $this->edit['crew_id'];
        }
        $task->priority = $this->edit['priority'];

        // Save the updated task
        $this->task->save();

        // Display success message or perform any other actions
        $this->dispatchBrowserEvent('success', ['message' => 'Task updated successfully.']);
    }


    public function render()
    {
        $users = User::all();
        $orders = ServiceOrder::all();
        $crews = Crew::all();
        return view('livewire.admin.task.edit-task', ['orders' => $orders, 'users' => $users, 'crews' => $crews]);
    }
}
