<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => "required | email",
            'question' => "required | string",
            'message' => "required | string",
            'code' => "required | string",
        ]);

        $details = [
            'title' => $request->question,
            'from' => $request->email,
            'body' => $request->message,
        ];

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($details));

        return Contact::create([
            'email' => $request->email,
            'question' => $request->question,
            'message' => $request->message,
            'code' => $request->code,
            "condition" => false
        ]);
    }
}
