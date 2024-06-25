<?php

namespace App\Http\Controllers;
use App\Models\Club;
use App\Models\User;
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
            $clubs=Club::all();
            return view('users.home')->with(compact('users','clubs'));
        }
        catch(Exception $e){
            return back()->with('error', $e);
        }
    }
}
