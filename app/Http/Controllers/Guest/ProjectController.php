<?php

namespace App\Http\Controllers\Guest;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;




class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            $projects = Project::all();

            return view('guest.projects.index', compact('projects'));
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('guest.projects.show', compact('project'));
    }

}




