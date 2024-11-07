<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    function dashboard()
    {
        // pick 5 latest events
        $events = Event::orderBy('created_at', 'desc')->take(10)->get();

        // get 8 latest organizations
        $organizations = User::where('role', 'organization')->orderBy('created_at', 'desc')->take(8)->get();

        return view('student.dashboard', compact('events', 'organizations'));
    }
}
