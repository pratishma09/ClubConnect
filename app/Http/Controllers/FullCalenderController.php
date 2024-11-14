<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch events within the requested date range
            $data = Event::whereDate('date', '>=', $request->start)
                         ->whereDate('date', '<=', $request->end)
                         ->get(['id', 'title', 'date as start']); // Assuming a single 'date' field for start and end

            return response()->json($data);
        }
        
        return view('users.events.calendar');
    }
 
    public function ajax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'date' => $request->start, // Assuming 'date' as start and end
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'date' => $request->start, // Assuming 'date' as start and end
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Event::find($request->id)->delete();

                return response()->json($event);
                break;
                
            default:
                return response()->json(['error' => 'Invalid type'], 400);
                break;
        }
    }
}
