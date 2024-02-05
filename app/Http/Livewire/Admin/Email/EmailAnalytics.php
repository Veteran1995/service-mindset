<?php

namespace App\Http\Livewire\Admin\Email;

use App\Models\Email;
use Livewire\Component;

class EmailAnalytics extends Component
{
    public function render()
    {
        $inbox = Email::where('receiver_id', auth()->user()->employee_id)->get();
        $sendbox = Email::where('sender_id', auth()->user()->employee_id)->get();
        $read = Email::where('receiver_id', auth()->user()->employee_id)
            ->where('status', 'read')->get();
        $unread = Email::where('receiver_id', auth()->user()->employee_id)
            ->where('status', 'unread')->get();

        return view('livewire.admin.email.email-analytics', ['inbox' => $inbox, 'sendbox' => $sendbox, 'read' => $read, 'unread' => $unread]);
    }
}
