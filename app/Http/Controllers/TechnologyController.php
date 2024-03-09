<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;

// Helpers
use Illuminate\Support\Str;


class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $technologyData = $request->validated();
        $slug = Str::slug($technologyData['title']);
        $technologyData['slug'] = $slug;
        $technology = Technology::create($technologyData);
        return redirect()->route('admin.technologies.show', ['technology' => $technology->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();

        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, string $slug)
    {
        $technologyData = $request->validated();
        $technology = Technology::where('slug', $slug)->firstOrFail();
        $slug = Str::slug($technologyData['title']);
        $technologyData['slug'] = $slug;
        $technology->updateOrFail($technologyData);

        return redirect()->route('admin.technologies.show', ['technology' => $technology->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        
        $technology->delete();

        return redirect()->route('admin.technologies.index');
    }
}
