<?php

namespace App\Http\Livewire\Admin\Email;

use App\Models\Email;
use App\Models\EmailAttachment;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Compose extends Component
{
    use WithFileUploads;
    public $content;
    public $subject;
    public $receiver_email;
    public $attachments = [];

    protected $listeners = ['emailSelected', 'ckeditorContentUpdated'];

    public function emailSelected($selectedEmail)
    {
        $this->receiver_email = $selectedEmail;
    }

    public function ckeditorContentUpdated($content)
    {
        // Handle the updated CKEditor content
        $this->content = $content;
        // You can perform any necessary actions with the content
    }

    public function sendEmail()
    {
        // Validate and retrieve the form data
        $validatedData = $this->validate([
            'subject' => 'required',
            'content' => 'required',
            'receiver_email' => 'required|email',
            'attachments.*' => 'file|max:5000', // Adjust the validation rules for attachments as needed
        ]);




        // Create a new email record
        $email = new Email();
        $email->subject = $validatedData['subject'];
        $email->body = $validatedData['content'];
        $email->sender_id = auth()->user()->employee_id;
        $email->receiver_id = User::where('email', $validatedData['receiver_email'])->value('employee_id');
        $email->save();

        // Handle email attachments (if any)
        if (isset($validatedData['attachments'])) {
            foreach ($validatedData['attachments'] as $attachment) {
                $path = $attachment->store('attachments', 'public'); // Adjust the storage path as needed

                // Create email attachment records
                $emailAttachment = new EmailAttachment();
                $emailAttachment->email_id = $email->id;
                $emailAttachment->filename = $attachment->getClientOriginalName();
                $emailAttachment->path = $path;
                $emailAttachment->type = $attachment->getClientOriginalExtension();
                $emailAttachment->save();
            }
        }

        $this->receiver_email = "";
        $this->subject = "";
        $this->content = "";
        $this->attachments = "";

        $this->dispatchBrowserEvent('success', ['message' => 'Mail Sent Successfully']);
    }
    public function render()
    {
        return view('livewire.admin.email.compose');
    }
}
