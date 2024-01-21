@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1>File Upload</h1>
        <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type=text placeholder="file name" name="title" value="{{ old('title') }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type=text placeholder="nom de fichier" name="title_fr" value="{{ old('title_fr') }}">
            @error('title_fr')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="file" name="file">
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <button type="submit">Upload</button>
        </form>
    </div>
@endsection


