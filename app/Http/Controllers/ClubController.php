<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;

use App\Http\Requests\ClubRequest;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $users=User::all();
            $clubs=Club::all();
            return view('admin.clubs.index')->with(compact('users','clubs'));
        }
        catch(Exception $e){
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::where('role', 'club')->get();
        $clubs=Club::all();
        return view('admin.clubs.create')->with(compact('users','clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // Validate incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'president' => 'required|string|max:255',
        'vice_president' => 'required|string|max:255',
        'tenure_date' => 'required|date',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'email' => 'required|email',
        'role' => 'required|string|in:admin,club',
    ]);

    try {
        // Create the user first
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt('password'), 
            'role' => $validatedData['role'],
        ]);

        if ($request->hasFile('logo')) {
            $filenameI = 'logo_' . uniqid() . '_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('assets'), $filenameI);
            $data['logo'] = $filenameI;
        }

        // Create the club with the user_id
        $club = Club::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'president' => $validatedData['president'],
            'vice_president' => $validatedData['vice_president'],
            'tenure_date' => $validatedData['tenure_date'],
            'user_id' => $user->id, // Assign the ID of the created user
            'logo' => $data['logo'],
            'initial_budget' => 25000, // Assuming default value for initial_budget
        ]);

        // Redirect to success page or return a response
        return redirect()->route('clubs.index')->with('success', 'Club created successfully!');
    } catch (Exception $e) {
        if (isset($user)) {
            $user->delete();
        }
        // Handle exceptions and errors
        return back()->with('error', 'Failed to create club. ' . $e->getMessage());
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            $club = Club::findOrFail($id);
            $users = User::where('role', 'club')->get();
            return view('admin.clubs.edit', compact('club', 'users'));
        } catch (Exception $e) {
            
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    try {
        $club = Club::findOrFail($id);
        $oldName = $club->name;
        $oldEmail = $club->user->email;

        // Update the club details
        $club->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'president' => $request->input('president'),
            'vice_president' => $request->input('vice_president'),
            'tenure_date' => $request->input('tenure_date'),
        ]);

        // Update associated user's email if it's changed
        if ($request->input('email') !== $oldEmail) {
            $user = User::where('name', $oldName)->first();
            if ($user) {
                $user->email = $request->input('email');
                $user->save();
            }
        }

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            if ($club->logo && file_exists(public_path('assets/' . $club->logo))) {
                unlink(public_path('assets/' . $club->logo));
            }

            $filename = 'logo_' . uniqid() . '_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('assets'), $filename);
            $club->update(['logo' => $filename]);
        }

        return redirect(route('clubs.index'))->with('success', 'Club updated successfully');
    } catch (ModelNotFoundException $e) {
        return back()->with('error', 'Database error!');
    } catch (Exception $e) {
        dd($e); // Use for debugging
        return back()->with('error', 'Something went wrong!');
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $club = Club::findOrFail($id);
            $club->delete();
            return redirect(route('clubs.index'))->with('success', 'Club deleted successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return back()->with('error', 'Cannot delete the club because it has related records.');
            }
        } catch (Exception $e) {
            dd($e);
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function userclub()
    {
        //
        try{
            $users=User::all();
            $clubs=Club::all();
            return view('users.clubs.index')->with(compact('users','clubs'));
        }
        catch(Exception $e){
            return back()->with('error', 'Something went wrong!');
        }
    }

}
