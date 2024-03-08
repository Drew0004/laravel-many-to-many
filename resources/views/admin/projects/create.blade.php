@extends('layouts.app')

@section('page-title', 'Crea Nuovo Progetto')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Sei loggato!
                    </h1>
                    <h2 class="text-center my-2">Aggiungi un nuovo progetto</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <form action="{{ route('admin.projects.store') }}" method="POST">
                    @csrf
                    <div class="my-3">
                        <label for="title" class="form-label text-white">Titolo*</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo..." maxlength="200" required value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <label for="type" class="form-label text-white">Tipologia</label>
                        <select class="form-select @error('type_id') is-invalid @enderror" aria-label="Default select example" id="type" name="type_id">
                            <option {{ old('type_id') == null ? 'selected' : '' }} value="">Valore vuoto</option>
                            @foreach ($types as $singleType){
                                <option 
                                {{ old('type_id') == $singleType->id ? 'selected' : '' }} 
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
                        <label class="form-label text-white">Tecnologie</label>
        
                        <div>
                            @foreach ($technologies as $technology)
                                <div class="form-check form-check-inline">
                                    <input
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
                                        class="form-check-input text-white"
                                        type="checkbox"
                                        id="technology-{{ $technology->id }}"
                                        name="technologies[]"
                                        value="{{ $technology->id }}">
                                    <label class="form-check-label text-white" for="technology-{{ $technology->id }}">{{ $technology->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="my-3">
                        <label for="description" class="form-label text-white">Descrizione*</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Aggiungi una descrizione" maxlength="1024" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <label for="client" class="form-label text-white">Cliente*</label>
                        <input type="text" class="form-control @error('client') is-invalid @enderror" id="client" name="client" placeholder="Inserisci il cliente..." maxlength="46" required value="{{ old('client') }}">
                        @error('client')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">
                        Aggiungi +
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection