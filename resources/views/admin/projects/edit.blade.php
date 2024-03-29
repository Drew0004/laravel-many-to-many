@extends('layouts.app')

@section('page-title', 'Edit project')

@section('main-content')
  <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="my-3">
                <label for="title" class="form-label text-white">Titolo*</label>
                <input value="{{ $project->title }}" type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo..." maxlength="200" required>
            </div>
            <div class="my-3">
                <label for="type" class="form-label text-white">Tipologia</label>
                <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Default select example" id="type" name="type_id">
                    <option {{ old('type_id',$project->type_id) == null ? 'selected' : '' }}>Valore vuoto</option>
                    @foreach ($types as $singleType){
                        <option 
                        {{ old('type_id',$project->type_id) == $singleType->id ? 'selected' : '' }} 
                        value="{{ $singleType->id }}">{{ $singleType->title }}</option>
                    }
                    @endforeach
                    @error('type_id')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tecnologie</label>

                <div>
                    @foreach ($technologies as $technology)
                        <div class="form-check form-check-inline">
                            <input
                                {{-- Se c'è l'old, vuol dire che c'è stato un errore --}}
                                @if ($errors->any())
                                    {{-- Faccio le verifiche sull'old --}}
                                    {{ in_array($technology->id, old('technology', [])) ? 'checked' : '' }}
                                @else
                                    {{-- Faccio le verifiche sulla collezione --}}
                                    {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}
                                @endif
                                class="form-check-input"
                                type="checkbox"
                                id="technology-{{ $technology->id }}"
                                name="technologies[]"
                                value="{{ $technology->id }}">
                            <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="cover_img" class="form-label text-white">Inserisci un'immagine</label>
                <input class="form-control @error('cover_img') is-invalid @enderror" type="file" id="cover_img" name="cover_img">

                @if ($project->cover_img != null)
                <div class="mt-2">
                    <h4 class="text-white">
                        Copertina attuale:
                    </h4>
                    <img src="/storage/{{ $project->cover_img }}" style="max-width: 200px;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="delete_cover_img" name="delete_cover_img">
                        <label class="form-check-label" for="delete_cover_img">
                            Rimuovi immagine
                        </label>
                    </div>
                </div>
            @endif
            </div>
            @error('cover_img')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <div class="my-3">
                <label for="description" class="form-label text-white">Descrizione*</label>
                <textarea  class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Aggiungi una descrizione" maxlength="1024" required>
                {{ $project->description }}
                </textarea>
            </div>
            <div class="my-3">
                <label for="client" class="form-label text-white">Cliente*</label>
                <input value="{{ $project->client }}" type="text" class="form-control @error('client') is-invalid @enderror" id="client" name="client" placeholder="Inserisci il cliente..." maxlength="46" required>
            </div>
            <button class="btn btn-primary" type="submit">
                Modifica +
            </button>
        </form>
    </div>
@endsection
