<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
// Helpers
use Illuminate\Support\Str;

// Form Requests
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\EditProjectRequest;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            $projects = Project::all();

            $types = Type::all();

            return view('admin.projects.index', compact('projects', 'types'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $projectData = $request->validated();
        $slug = Str::slug($projectData['title']);
        $projectData['slug'] = $slug;
        $project = Project::create($projectData);
        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $types = Type::all();
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('admin.projects.edit', compact('project','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProjectRequest $request, string $slug)
    {
        $projectData = $request->validated();
        $project = Project::where('slug', $slug)->firstOrFail();
        $slug = Str::slug($projectData['title']);
        $projectData['slug'] = $slug;
        $project->updateOrFail($projectData);

        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}




