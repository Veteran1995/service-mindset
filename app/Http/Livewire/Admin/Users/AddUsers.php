<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Component;

class AddUsers extends Component
{
    use WithFileUploads;

    public $state = [];
    public $isCreating = false;
    public $image;

    protected $rules = [
        'state.email' => 'required|email|unique:users,email',
        'state.role' => 'required',
        'state.password' => 'required|min:6|confirmed',
        'state.firstname' => 'required',
        'state.lastname' => 'required',
        'state.job' => 'required',
        'state.department' => 'required',
        'image' => 'nullable|image|max:4096',
    ];

    public function addUser()
    {
        $this->validate();

        $this->isCreating = true; // Set the flag to indicate user creation is in progress

        // Upload and store the image if provided
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        User::create([
            'email' => $this->state['email'],
            'role' => $this->state['role'],
            'password' => Hash::make($this->state['password']),
            'firstname' => $this->state['firstname'],
            'lastname' => $this->state['lastname'],
            'job' => $this->state['job'],
            'department' => $this->state['department'],
            'employee_id' => mt_rand(10000000, 99999999),
            'image' => $imagePath,
        ]);

        // Clear the form fields
        $this->state = [];

        $this->isCreating = false; // Reset the flag after user creation is complete

        // Dispatch a browser event
        $this->dispatchBrowserEvent('success', ['message' => 'User created successfully.']);
    }

    public function render()
    {
        return view('livewire.admin.users.add-users');
    }
}
