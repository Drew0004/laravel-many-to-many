@extends('layouts.app')

@section('page-title', 'Tutti i progetti')

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
                            <th scope="col">Description</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Client</th>
                            <th scope="col">Created at</th>
                            <th scope="col" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->id }}</th>
                                <td>{{ $project->title }}</td>
                                @isset($project->type)
                                    <td>{{ $project->type->title }}</td>
                                @else 
                                    <td>-</td>
                                @endisset
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->slug }}</td>
                                <td>{{ $project->client }}</td>
                                <td>{{ $project->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}" class="btn btn-xs btn-primary">
                                        Show
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('admin.projects.edit',['project' => $project->slug]) }}">
                                        edit
                                    </a>
                                </td>
                                <td>
                                    
                                    <button type="button" class="btn btn-danger" data-bs-toggle="offcanvas"
                                    data-bs-target="#deleteConfirmation{{ $project->slug , $project->title }}">
                                    Elimina
                                    </button>

                                <div class="offcanvas offcanvas-end d" tabindex="-1"
                                    id="deleteConfirmation{{ $project->slug , $project->title }}">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="deleteConfirmationLabel{{ $project->slug , $project->title }}">
                                            Conferma eliminazione
                                        </h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <p>Vuoi davvero eliminare <h5 class=" d-inline-block ">{{ $project->title }}</h5> ?</p>
                                        <form class="mt-5" id="deleteForm{{ $project->slug }}"
                                            action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Conferma eliminazione</button>
                                        </form>
                                    </div>
                                </div>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection