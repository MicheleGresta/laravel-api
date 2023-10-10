@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="show-box-custom d-flex flex-column align-items-center mt-5 gap-3">
            <h3>show</h3>
            <div class="image-box">
                <img src="{{ asset('storage/' . $projects->image) }}">
            </div>
            <div class="card-body card-box">
                <h4><strong>Project Title: </strong>{{ $projects->title }}</h4>
                <h5><strong>Description: </strong>{{ $projects->description }}</h5>
                <p><strong>Publish date: </strong>{{ $projects->date }}</p>
                <p><strong>Languages Used: </strong>{{ implode(', ', $projects->language) }}</p>
                <a href="{{ $projects->link }}" class="btn btn-outline-info">
                    <h5><strong>GitHub link</strong></h5>
                </a>
                <div class="my-3">
                    <a href="{{ route('admin.projects.edit', $projects->id) }}" class="btn btn-outline-warning"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('admin.projects.destroy', $projects->id) }}" method="post"
                        class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger mx-3"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        {{-- container closing tag --}}
    </div>
@endsection
