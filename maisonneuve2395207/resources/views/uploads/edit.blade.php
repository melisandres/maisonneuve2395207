@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1>@lang('lang.uploads_edit_heading')</h1>
        <form action="{{  route('upload.update', ['upload' => $upload->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="title">@lang('lang.article_title_english'):</label>
            <input type=text placeholder="file name" name="title" value="{{ old('title', $upload->title) }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <label for="title_fr">@lang('lang.article_title_french'):</label>
            <input type=text placeholder="nom de fichier"name="title_fr" value="{{ old('title_fr', $upload->title_fr) }}">
            @error('title_fr')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <!-- Display the existing file or show "Choose File" -->
            <div>
                <input type="file" name="file" id="file" style="display: none;">
                <button type="button" onclick="document.getElementById('file').click()">@lang('lang.text_choose_new_file')</button>
                <span id="file-info">{{ $upload->file_path }}</span>
            </div>
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <button type="submit">@lang('lang.text_upload')</button>
        </form>
    </div>

    <script>
        var langNoFile = "{{ $upload->file_path }}";
    </script>

    <script>
        // Display the existing file name or "No file chosen"
        document.getElementById('file').addEventListener('change', function () {
            var fileInfo = document.getElementById('file-info');
            fileInfo.textContent = this.files.length > 0 ? this.files[0].name : langNoFile;
        });
    </script>
@endsection