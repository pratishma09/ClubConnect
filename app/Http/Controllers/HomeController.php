<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\User;
use App\Models\Club;
use Exception;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function userhome()
    {
        //
        try{
            $users=User::all();
            $events=Event::all();
            $clubs=Club::all();
            return view('users.home')->with(compact('users','clubs','events'));
        }
        catch(Exception $e){
            return back()->with('error', $e);
        }
    }
}
