<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;

use App\Http\Requests\ClubRequest;

use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
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
    public function store(ClubRequest $request)
    {
        //
        try{
            $data=$request->validated();
            if ($request->hasFile('logo')) {
                $filenameI = 'logo_' . uniqid() . '_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('assets'), $filenameI);
                $data['logo'] = $filenameI;
            }
            $club = Club::create($data);
            $clubs=Club::all();

            return view('admin.clubs.index')->with('success', 'Club created successfully!')->with(compact('clubs'));
        }
        catch(Exception $e){
            
            return back()->with('error', 'Something went wrong!');
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
    public function update(ClubRequest $request, string $id)
    {
        //
        try {
            $club = club::findOrFail($id);
            $club->update($request->all());

            if ($request->hasFile('logo')) {

                if ($club->logo && file_exists(public_path('assets/' . $club->logo))) {
                    unlink(public_path('assets/' . $club->logo));
                }

                $filenameI = 'logo_' . uniqid() . '_' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->move(public_path('assets'), $filenameI);
                $club->update(['logo' => $filenameI]);
            }
            return redirect(route('clubs.index'))->with('success', 'Club updated successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Database error!');
        } catch (Exception $e) {
            dd($e);
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
