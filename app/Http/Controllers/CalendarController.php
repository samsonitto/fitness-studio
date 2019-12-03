<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\ClassIsAvailable;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }

    public function my_courses()
    {
        $courses = DB::table('calendar')
        ->where('teacher_id','=',Auth::id())
        ->get();
        return view('courses')->with('courses', $courses);
    }
}
