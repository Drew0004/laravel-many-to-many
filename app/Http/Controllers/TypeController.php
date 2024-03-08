<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

// Helpers
use Illuminate\Support\Str;

// Form Requests
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\EditTypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $typeData = $request->validated();
        $slug = Str::slug($typeData['title']);
        $typeData['slug'] = $slug;
        $type = Type::create($typeData);
        return redirect()->route('admin.types.show', ['type' => $type->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();

        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditTypeRequest $request, string $slug)
    {
        $typeData = $request->validated();
        $type = Type::where('slug', $slug)->firstOrFail();
        $slug = Str::slug($typeData['title']);
        $typeData['slug'] = $slug;
        $type->updateOrFail($typeData);

        return redirect()->route('admin.types.show', ['type' => $type->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $type = Type::where('slug', $slug)->firstOrFail();
        
        $type->delete();

        return redirect()->route('admin.types.index');
    }
}
