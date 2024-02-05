<?php

namespace App\Http\Livewire\Admin\Email;

use App\Models\Email;
use Livewire\Component;

class EmailSidebar extends Component
{
    public function render()
    {
        $contacts = Email::select('receiver_id')
            ->where('sender_id', auth()->user()->employee_id)
            ->distinct()
            ->get();

        $totalMail = Email::where('receiver_id', auth()->user()->employee_id)->count();
        $totalSent = Email::where('sender_id', auth()->user()->employee_id)->count();
        $read = Email::where('receiver_id', auth()->user()->employee_id)
            ->where('status', 'read')->count();
        $unread = Email::where('receiver_id', auth()->user()->employee_id)
            ->where('status', 'unread')->count();
        return view('livewire.admin.email.email-sidebar', ['totalMail' => $totalMail, 'totalSent' => $totalSent, 'contacts' => $contacts, 'read' => $read, 'unread' => $unread]);
    }
}
