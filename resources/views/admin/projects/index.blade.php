@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>home</h1>   

        <div class="row row-cols-6">
            @foreach ($projects as $project)
                <div class="col py-3">
                    <div class="card d-flex gap-3">
                        <a href="{{ route('admin.projects.show'), $project->id }}">
                            <img src="{{ $project['image'] }}">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
