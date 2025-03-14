<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Exception;

class ParticipationController extends Controller
{
    //
    public function clubparticipation() {
        try {
            $events = Event::all();
    
            $eventData = $events->map(function ($event) {
                return [
                    'event' => $event->title,
                    'no_of_participants' => $event->no_of_participants ?? 0,
                ];
            });
    
            $sortedEvents = $eventData->sortByDesc('no_of_participants')->values();
            return view('clubs.participation.show', compact('sortedEvents'));
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }
    
    
}
