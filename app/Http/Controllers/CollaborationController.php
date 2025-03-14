<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Event;
use App\Models\User;
use App\Notifications\CollaborationRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();
        $events = Event::where('user_id', $user->id)->get();
        return view('clubs.events.viewnotify', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function collaborate(Request $request, $eventId)
    {
        try {
            $event = Event::findOrFail($eventId);
            $user = Auth::user();
            if (!$user) {
                return redirect()->back()->with('error', 'You are not logged in.');
            }
            if (!$event->users()->where('user_id', $user->id)->exists()) {
                $event->users()->attach($user->id, ['status' => 'pending']);
                $event = $event->fresh();
                if ($event->user) {
                    $event->user->notify(new CollaborationRequest($event, $user));
                }
            }

            return redirect()->back()->with('success', 'Collaboration request sent.');
        } catch (Exception $e) {
            dd($e);
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function acceptCollaboration(Request $request, $eventId, $userId)
    {
        try {
            $event = Event::findOrFail($eventId);

            if (Auth::user()->id !== $event->user_id) {
                return redirect()->back()->with('error', 'You are not authorized to approve this collaboration.');
            }

            $event->users()->updateExistingPivot($userId, ['status' => 'accepted']);

            $user = User::findOrFail($userId);
            $collaborators = json_decode($event->collaborators, true) ?? [];
            if (!in_array($user->name, $collaborators)) {
                $collaborators[] = $user->name;
            }
            $event->update(['collaborators' => json_encode($collaborators)]);
            return redirect()->back()->with('success', 'Collaboration accepted and event updated with collaborators.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Event or user not found.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    public function rejectCollaboration(Request $request, $eventId, $userId)
    {
        $event = Event::findOrFail($eventId);
        if (Auth::user()->id !== $event->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to reject this collaboration.');
        }
        $event->users()->updateExistingPivot($userId, ['status' => 'rejected']);
        return redirect()->back()->with('success', 'Collaboration rejected.');
    }

}
