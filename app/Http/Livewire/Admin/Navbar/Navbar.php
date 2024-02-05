<?php

namespace App\Http\Livewire\Admin\Navbar;

use App\Models\Email;
use Livewire\Component;
use PhpParser\Node\Stmt\Foreach_;

class Navbar extends Component
{
    public $emails;

    protected $listeners = ['refreshComponent' => 'refresh'];

    public function refresh()
    {
        $this->notification();
        $this->messages();
        // Perform the actions you want to execute every 5 minutes
    }
    public function notification()
    {
        $emails = Email::where('receiver_id', auth()->user()->employee_id)
            ->where('notification', 'unseen')
            ->get();
        foreach ($emails as $key => $email) {
            $email->update(['notification' => 'seen']);
            $this->dispatchBrowserEvent('toastSuccess', ['message' => $email->sender->firstname . ' ' . $email->sender->lastname . ' Sent You a Message']);
        }
    }

    public function messages()
    {
        $this->emails = Email::where('receiver_id', auth()->user()->employee_id)
            ->where('status', 'unread')
            ->limit(6)
            ->get();
    }



    public function render()
    {
        $this->emails = Email::where('receiver_id', auth()->user()->employee_id)
            ->where('status', 'unread')
            ->limit(6)
            ->get();

        return view('livewire.admin.navbar.navbar', ['emails' => $this->emails]);
    }
}
