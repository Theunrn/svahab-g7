<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title' => 'Mail from Surfside Media',
            'body' => 'This is for testing mail using gmail.'
        ];

        try {
            Mail::to('liep.toeur@student.passerellesnumeriques.org')->send(new TestMail($details));
            return "Email sent successfully";
        } catch (\Exception $e) {
            return "Failed to send email: " . $e->getMessage();
        }
    }
}
