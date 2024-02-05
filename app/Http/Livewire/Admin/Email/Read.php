<?php

namespace App\Http\Livewire\Admin\Email;

use App\Models\Email;
use Livewire\Component;

class Read extends Component
{
    public $email;

    public function mount(Email $email_id)
    {
        $this->email = $email_id;
        $this->email->update(['status' => 'read']);
    }
    public function render()
    {
        return view('livewire.admin.email.read');
    }
}
