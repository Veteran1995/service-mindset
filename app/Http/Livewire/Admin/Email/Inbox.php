<?php

namespace App\Http\Livewire\Admin\Email;

use App\Models\Email;
use Livewire\Component;
use Livewire\WithPagination;

class Inbox extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public function render()
    {
        $emails = Email::where('receiver_id', auth()->user()->employee_id)->paginate(10);
        return view('livewire.admin.email.inbox', ['emails' => $emails]);
    }
}
