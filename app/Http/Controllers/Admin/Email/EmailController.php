<?php

namespace App\Http\Controllers\Admin\Email;

use App\Models\Email;
use ZipArchive;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function inbox()
    {
        return view('admin.Email.inbox');
    }

    public function compose()
    {
        return view('admin.Email.compose');
    }

    public function sent()
    {
        return view('admin.Email.sent');
    }

    public function read($email_id)
    {
        return view('admin.Email.read')->with('email_id', $email_id);;
    }

    public function unread()
    {
        return view('admin.Email.unread');
    }

    public function messageRead()
    {
        return view('admin.Email.message-read');
    }

    public function downloadAllAttachments(Email $email)
    {
        // Retrieve all attachments for the email
        $attachments = $email->attachments;

        // Create a ZipArchive instance
        $zip = new ZipArchive;
        $zipName = 'email_attachments.zip';

        // Create a temporary file to store the zip archive
        $tempFile = tempnam(sys_get_temp_dir(), $zipName);

        // Create the zip archive and add each attachment to it
        if ($zip->open($tempFile, ZipArchive::CREATE) === true) {
            foreach ($attachments as $attachment) {
                // Get the full path of the attachment file
                $filePath = storage_path('app/public/' . $attachment->path);

                // Add the attachment to the zip archive with a unique name
                $zip->addFile($filePath, $attachment->filename);
            }

            $zip->close();
        }

        // Set the appropriate headers for the download
        return response()->download($tempFile, $zipName)->deleteFileAfterSend();
    }
}
