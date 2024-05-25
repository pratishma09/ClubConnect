<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        Auth::logout();
        return redirect('/login');
    }
    
}