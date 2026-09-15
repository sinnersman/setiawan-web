<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // Delivery (mail / database) is handled by the backend track.
        // For now we acknowledge receipt so the UI toast can confirm.
        $request->session()->flash('toast', [
            'type'    => 'success',
            'title'   => 'Message sent',
            'message' => 'Thanks ' . $validated['name'] . ', your message has been received. I will reply soon.',
        ]);

        return redirect()->to(route('home') . '#contact');
    }
}
