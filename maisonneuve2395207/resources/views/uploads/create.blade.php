@extends('layouts.layout')
@section('content')
    <div class="container">
        <h1>File Upload</h1>
<!-- 
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif -->

        <!-- Your file upload form goes here -->
        <form action="{{ route('upload.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type=text placeholder="file name" name="title">
            <input type=text placeholder="nom de fichier"name="title_fr">

            <input type="file" name="file">
            <button type="submit">Upload</button>
        </form>
    </div>
@endsection


