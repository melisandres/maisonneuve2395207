@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1>@lang('lang.uploads_create_heading')</h1>
        <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">@lang('lang.text_file_name_en'):</label>
            <input type=text placeholder="file name" name="title" value="{{ old('title') }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="title_fr">@lang('lang.text_file_name_fr'):</label>
            <input type=text placeholder="nom de fichier" name="title_fr" value="{{ old('title_fr') }}">
            @error('title_fr')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <input type="file" name="file">
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <button type="submit">@lang('lang.text_upload')</button>
        </form>
    </div>
@endsection


