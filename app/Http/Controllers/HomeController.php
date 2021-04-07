<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Projects;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $all_projects = Projects::all();
        $projects = Projects::where('owner_id', Auth::id())->get();

        foreach ($all_projects as $project) {
            if(count($project->users)) {
                $isUserInsideProject = $project->users->filter(function($item) { return $item->id == Auth::id(); })->first();
                if($isUserInsideProject !== null) {
                    $projects[] = $project;
                }
            }
        }
        return view('home', compact('projects'));
    }
}
