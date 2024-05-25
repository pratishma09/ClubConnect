<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\ContactRequest;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request): RedirectResponse
    {
        $data=$request->validated();
        $contact=ContactRequest::create($data);

        return redirect()->route('contact.form')->with('success', 'Your contact request has been submitted successfully!');
    }

    public function create()
    {
        return view('users.contact.form');
    }
}
