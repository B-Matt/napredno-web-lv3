<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function index() {
        $users = User::all()->except(Auth::id())->map(function($user) { return $user->name; });
        return view('new', compact('users'));
    }

    public function store(Request $request) {
        
        $request->validate([
            'name' => 'required|string|unique:projects',
            'description' => 'required|string',
            'tasks_done' => 'required|string',
            'project_price' => 'required'
        ]);
        $users = User::where('id', '!=', Auth::id())->pluck('name', 'id');

        $project = new Projects();
        $project->owner()->associate(Auth::user());
        $project->name = $request->name;
        $project->description = $request->description;
        $project->price = $request->project_price;
        $project->tasks_done = $request->tasks_done;
        $project->started = Carbon::now();
        $project->finished = null;
        $project->save();
        
        $project->users()->attach(array_keys($users->toArray()));
        $project->save();

        return redirect()->route('home');
    }

    public function edit(Request $request, Projects $project) {
        if($project->owner_id == Auth::id()) {
            $users = User::all()->except(Auth::id())->map(function($user) { return $user->name; });
            $is_project_owner = true;
        } else {
            $users = User::all()->except($project->owner_id)->map(function($user) { return $user->name; });
            $is_project_owner = false;
        }

        $selected_users = [];
        $i = 0;

        foreach ($users as $user) {
            $isUserInsideProject = $project->users->filter(function($item) use($user) { return $user == $item->name; })->first();
            if($isUserInsideProject != null) {
                $selected_users[] = $i;
            }
            $i++;
        }

        
        return view('edit', compact('project', 'users', 'selected_users', 'is_project_owner'));
    }

    public function update(Request $request, Projects $project) {
        if($project->owner_id == Auth::id()) {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'tasks_done' => 'required|string',
                'price' => 'required'
            ]);

            $project->name = $request->name;
            $project->description = $request->description;
            $project->price = $request->price;
            $project->tasks_done = $request->tasks_done;
            $project->save();
            
            $project->users()->attach($request->users);
            $project->save();

        }
        else {
            $request->validate([
                'tasks_done' => 'required|string'
            ]); 
            $project->tasks_done = $request->tasks_done;
            $project->save();
        }
        return redirect()->route('home');
    }
}
