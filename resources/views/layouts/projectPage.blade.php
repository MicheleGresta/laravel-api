@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>projects</h1>

        <div class="row row-cols-5 d-flex gap-3">
            @foreach ($projects as $project)
                <div class="col py-3">
                    <div class="card card-custom h-100 d-flex flex-column justify-content-end gap-3">
                        <a href="{{ route('admin.projects.show', $project->id) }}">
                            <img src="{{ $project->image }}">
                            <h5>{{$project->title}}</h5>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
