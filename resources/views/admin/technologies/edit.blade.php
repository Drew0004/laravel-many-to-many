@extends('layouts.app')

@section('page-title', 'Modifica Una Nuova Tecnologia')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Sei loggato!
                    </h1>
                    <h2 class="text-center my-2">Modifica una nuova Tecnologia</h2>
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
                <form action="{{ route('admin.technologies.update', ['technology' => $technology->slug]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-3">
                        <label for="title" class="form-label text-white">Titolo*</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo..." maxlength="200" required value="{{ $technology->title }}">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">
                        Modifica +
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
