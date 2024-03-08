@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">
                        Welcome!
                    </h1>
                    <br>
                    La welcome page è una pagina pubblica (NON protetta)

                    <a class="btn btn-primary " href="{{ route('projects.index') }}">Vai a tutti i progetti</a>
                </div>
            </div>
        </div>
    </div>
@endsection
