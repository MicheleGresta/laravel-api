@extends('layouts.app')
@section('content')
    <div class="container">

        <h1>create</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        placeholder="Project Title" value="{{ old("title", $projects->title)}}">
                    @error('title')
                        <div class="invalid-feedback">
                            Title Requested
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="file" name="image" accept="image/*">
                    {{-- <input type="text" class="form-control" name="image" placeholder="URL image" value="{{ old("image", $projects->image)}}"> --}}
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="text" class="form-control" name="description" placeholder="Description" value="{{ old("description", $projects->description)}}">
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="text" class="form-control @error('link') is-invalid @enderror" name="link"
                        placeholder="Link GitHub" value="{{ old("link", $projects->link)}}">
                    @error('link')
                        <div class="invalid-feedback">
                            Link Requested
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="date" class="form-control" name="date" placeholder="Publish Date" value="{{ old("date", $projects->date)}}">
                </div>
            </div>
            <div class="col-md-6 py-3">
                <div class="input-size">
                    <input type="text" class="form-control" name="language" placeholder="Languages Used" value="{{ old("language", implode(', ', $projects->language))}}">
                </div>
            </div>
            <div class="col-md-6 py-3">
                <select name="type_id" id="type_id" class="form-select" @error("types_id") is-invalid @enderror>
                    @foreach ( $types as $type)                        
                    <option value="{{$type->id}}">{{$type->type}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary my-3">Update Project to your Page</button>
            </form>

    </div>{{-- chiusura container --}}
@endsection
