@extends('layouts.app')

@section('page-title', $project->title)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Sei loggato!
                    </h1>
                    <br>
                    Pagina Index
                </div>
            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col">Technologies</th>
                            <th scope="col">Description</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Client</th>
                            <th scope="col">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            @isset($project->type)
                                <td>{{ $project->type->title }}</td>
                            @else 
                                <td>-</td>
                            @endisset
                            <td>
                                @forelse ($project->technologies as $technology)
                                    
                                    <span class="badge text-bg-primary">{{ $technology->title }}</span>
                                    
                                @empty
                                    -
                                @endforelse
                            </td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->slug }}</td>
                            <td>{{ $project->client }}</td>
                            <td>{{ $project->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


