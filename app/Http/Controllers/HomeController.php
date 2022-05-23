<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Work;
use App\Models\Member;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \AUTH::user();

        $projects = Project::where('user_id',$user['id'])->orderby('schedule_end','asc')->paginate(15);

        $project_box = 'on';

        $members = member::where('user_id',$user['id'])->get();
        // dd($members);

        if($members -> isEmpty())
        {
            return view('workout.tutorial',compact('projects','members','project_box'));
        }

        return view('layouts.app',compact('projects','members','project_box'));
    }
}
