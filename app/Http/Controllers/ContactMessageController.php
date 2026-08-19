<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $contactMessages = ContactMessage::latest()->paginate(15);

        return view('contact-messages.index', compact('contactMessages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if (! $contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }

        return view('contact-messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('contact-messages.index')->with('success', 'Message deleted successfully');
    }
}
