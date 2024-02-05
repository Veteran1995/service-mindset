<?php

namespace App\Http\Livewire\Admin\Email;

use App\Models\Email;
use Livewire\Component;
use Livewire\WithPagination;

class Sent extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public function render()
    {
        $emails = Email::where('sender_id', auth()->user()->employee_id)->paginate(10);
        return view('livewire.admin.email.sent', ['emails' => $emails]);
    }
}
