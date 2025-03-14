<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\ContactRequest;
use App\Models\contact;

use Exception;
use Illuminate\Database\QueryException;
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

    public function show()
    {
        $contacts=ContactRequest::all();
        return view('admin.contact.show')->with(compact('contacts'));
    }

    public function destroy(string $id)
    {
        //
        try {
            $contact = ContactRequest::findOrFail($id);
            $contact->delete();
            return redirect(route('contact.show'))->with('success', 'Contact deleted successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return back()->with('error', 'Cannot delete the contact because it has related records.');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
