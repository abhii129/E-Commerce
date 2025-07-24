<?php

namespace App\Http\Controllers;

use App\Models\FooterMessage; // Make sure this is included
use Illuminate\Http\Request;

class FooterMessageController extends Controller
{
    // Show the form to edit footer message for a specific section
    public function edit($section)
    {
        // Try to get the message for the specified section
        $message = FooterMessage::where('section', $section)->first();
    
        // If no message found, initialize a new one with empty content
        if (!$message) {
            $message = new FooterMessage();
            $message->section = $section;
            $message->message = ''; // Set a default empty message or any placeholder
        }
    
        return view('admin.footer-messages.edit', compact('message'));
    }
    

    // Update the footer message for a specific section
    public function update(Request $request, $section)
    {
        $request->validate([
            'message' => 'required',
        ]);

        FooterMessage::updateOrCreate(
            ['section' => $section],
            ['message' => $request->message]
        );

        return redirect()->route('admin.footer-messages.edit', ['section' => $section])
                         ->with('success', 'Message updated successfully');
    }
    public function showFooterMessage($section)
    {
        // Check for valid section
        $message = FooterMessage::where('section', $section)->first();

        // If no message is found, use a default message
        if (!$message) {
            $message = new \stdClass(); // Create an empty object if no message found
            $message->message = 'Sorry, no message available for this section.';
            $message->section = $section;
        }

        return view('admin.footer.customer-service', compact('message'));
    }
}
