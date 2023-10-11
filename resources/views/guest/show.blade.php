@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>show public</h3>
        <div class="image-box">
            <img src="{{ $projects->image }}">
        </div>
        <div class="card-body card-box">
            <h4>{{ $projects->title }}</h4>
            <h5>{{ $projects->description }}</h5>
            <a href="{{ $projects->link }}">
                <h5>{{ $projects->link }}</h5>
            </a>
            <p>{{ $projects->date }}</p>
            <p>{{ implode(', ', $projects->language) }}</p>
            <h5>{{$types->type}}</h5>
        </div>
    </div>
@endsection
