@extends('layouts.app')
@section('content')
    <div class="container">

        <h1>create</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        placeholder="Project Title">
                    @error('title')
                        <div class="invalid-feedback">
                            Title Requested
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input class="form-control" type="file" name="image" accept="image/*">
                    {{-- <input type="text" class="form-control" name="image-text" placeholder="URL image"> --}}
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="text" class="form-control" name="description" placeholder="Description">
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="text" class="form-control @error('link') is-invalid @enderror" name="link"
                        placeholder="Link GitHub">
                    @error('link')
                        <div class="invalid-feedback">
                            Link Requested
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="date" class="form-control" name="date" placeholder="Publish Date">
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="text" class="form-control" name="language" placeholder="Languages Used">
                </div>
            </div>
            <div class="col-md-6 py-3">
                <select name="type_id" id="type_id" class="form-select">
                    @foreach ( $types as $type)                        
                    <option value="{{$type->id}}">{{$type->type}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary my-3">Add Project to your Page</button>
            </form>

    </div>{{-- chiusura container --}}
@endsection
