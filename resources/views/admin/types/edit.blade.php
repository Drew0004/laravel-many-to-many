@extends('layouts.app')

@section('page-title', 'Edit Type')

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
        <form action="{{ route('admin.types.update', ['type' => $type->slug]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="my-3">
                <label for="title" class="form-label text-white">Titolo*</label>
                <input value="{{ $type->title }}" type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo..." maxlength="200" required>
            </div>
        
            <button class="btn btn-primary" type="submit">
                Modifica +
            </button>
        </form>
    </div>
@endsection
