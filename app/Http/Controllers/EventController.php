<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Club;
use App\Models\User;
use App\Notifications\CollaborationRequest;
use App\Http\Requests\EventRequest;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\EventCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    try {
        $user = auth()->user();

        $events = Event::where('user_id', $user->id)->get();

        return view('clubs.events.index', compact('events'));
    } catch (Exception $e) {
        return back()->with('error', 'Something went wrong!');
    }
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clubs = Club::all();
        return view('clubs.events.create', compact('clubs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
{
    try {
        $user = auth()->user();

        $club = Club::where('name', $user->name)->first();

        if (!$club) {
            return back()->with('error', 'No club found with the same name as the user.');
        }

        $data = $request->validated();

        $data['club_id'] = $club->id;

        if ($request->hasFile('photo')) {
            $filename = 'photo_' . uniqid() . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('assets'), $filename);
            $data['photo'] = $filename;
        }
        
        $event=Event::create($data);
        event(new EventCreated($event));
        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    } catch (Exception $e) {
        dd($e);
        return back()->with('error', 'Something went wrong!');
    }
}
public function show()
    {
        $event = Event::all();
        
        return view('clubs.events.viewnotify', compact('event'));
    }

    public function showuser($id)
    {
        $event = Event::findOrFail($id);
        $collaborators = json_decode($event->collaborators, true);
        $events = Event::latest()->take(3)->get();
        return view('users.events.showuser', compact('event','events','collaborators'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $eventDate = Carbon::parse($event->date);
        $today = Carbon::now();

        if ($eventDate->isPast()) {
            return redirect()->route('events.report.edit', $id);
        }

        return view('clubs.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->update($request->all());

            if ($request->hasFile('photo')) {
                if ($event->photo && file_exists(public_path('assets/' . $event->photo))) {
                    unlink(public_path('assets/' . $event->photo));
                }

                $filename = 'photo_' . uniqid() . '_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
                $request->file('photo')->move(public_path('assets'), $filename);
                $event->update(['photo' => $filename]);
            }

            return redirect(route('events.index'))->with('success', 'Event updated successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Event not found!');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            return redirect(route('events.index'))->with('success', 'Event deleted successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return back()->with('error', 'Cannot delete the event because it has related records.');
            }
        } catch (Exception $e) {
            dd($e);
            return back()->with('error', 'Something went wrong!');
        }
    }
    public function editReport($id)
    {
        $event = Event::findOrFail($id);
        return view('clubs.events.report', compact('event'));
    }

    public function updateReport(Request $request, $id)
    {
        $request->validate([
            'report_description' => 'required|string',
            'report_images.*' => 'required|mimes:jpg,jpeg,png',
        ]);

        $event = Event::findOrFail($id);
        $data = $request->only('report_description');

        if ($request->hasFile('report_images')) {
            $images = [];
            foreach ($request->file('report_images') as $file) {
                $filename = 'report_' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets'), $filename);
                $images[] = $filename;
            }
            $data['report_images'] = json_encode($images);
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Report updated successfully!');
    }

    public function all(){
        try{
            $events=Event::all();
            return view('clubs.events.all', compact('events'));
        }
        catch(Exception $e){
            dd($e);
            return back()->with('error', 'Something went wrong!');
        }
    }
    public function collaborate(Request $request, $eventId)
    {
        try{
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
        }
        catch(Exception $e){
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

    public function userevent()
{
    $events = Event::with('user')->get();
    return view('users.events.index', compact('events'));
}

}
