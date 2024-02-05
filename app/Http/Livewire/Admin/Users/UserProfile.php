<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Task;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Component;
use Livewire\Request;

class UserProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $tasks;
    public $state = [];

    public $isCreating = false;
    public $image;

    public function rules()
    {
        return [
            'state.email' => 'required|email|unique:users,email,' . $this->user->id,
            'state.role' => 'required',
            'state.firstname' => 'required',
            'state.lastname' => 'required',
            'state.job' => 'required',
            'state.department' => 'required',
            'image' => 'nullable|image|max:4096',
        ];
    }



    public function mount(User $user_id)
    {
        $this->user = $user_id;
        $this->state = $user_id->toArray();
    }

    public function updateUser()
    {
        $this->validate();

        $this->isCreating = true; // Set the flag to indicate user creation is in progress

        // Upload and store the image if provided
        $imagePath = $this->user->image;

        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        $this->user->update([
            'email' => $this->state['email'],
            'role' => $this->state['role'],
            'firstname' => $this->state['firstname'],
            'lastname' => $this->state['lastname'],
            'job' => $this->state['job'],
            'department' => $this->state['department'],
            'image' => $imagePath,
        ]);

        // Clear the form fields
        $this->state = $this->user->toArray();

        $this->isCreating = false; // Reset the flag after user creation is complete

        // Dispatch a browser event
        $this->dispatchBrowserEvent('success', ['message' => 'User Profile Updated successfully.']);
    }

    public function activeAccount()
    {
        $this->user->update(['status' => 1]);
        // Dispatch a browser event
        $this->dispatchBrowserEvent('toastSuccess', ['message' => 'User Account Activated successfully.']);
    }

    public function deActiveAccount()
    {
        $this->user->update(['status' => 0]);
        // Dispatch a browser event
        $this->dispatchBrowserEvent('toastSuccess', ['message' => 'User Account Deactivated successfully.']);
    }

    public function render()
    {
        $this->tasks = Task::where('assigned_to_id',  $this->user->employee_id)->get();
        return view('livewire.admin.users.user-profile', ['tasks' =>  $this->tasks]);
    }
}
