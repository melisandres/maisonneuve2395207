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

            <!-- Display the existing file or show "Choose File" -->
            <div>
                <input type="file" name="file" id="file" style="display: none;">
                <button type="button" onclick="document.getElementById('file').click()">@lang('lang.text_chose_file')</button>
                <span id="file-info">@lang('lang.text_no_file')</span>
            </div>
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <button type="submit">@lang('lang.text_upload')</button>
        </form>
    </div>

<script>
    var langNoFile = "@lang('lang.text_no_file')";
</script>

<script>
    document.getElementById('file').addEventListener('change', function () {
        var fileInfo = document.getElementById('file-info');
        fileInfo.textContent = this.files.length > 0 ? this.files[0].name : langNoFile;
    });
</script>
@endsection


