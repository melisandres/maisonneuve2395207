@extends('layouts.layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-8">
            Click on a file to view it!
        </div>
        <div class="col-4">
            <a href="{{ route('upload.create')}}" class="btn btn-primary">Add</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Our files</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>File Title</th>
                                <th>Action</th>
                                <th>Modify</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($uploads as $upload)
                                <tr>
                                    <td>{{ $upload->hasUser->name }}</td>
                                    <td>{{ $upload->title }}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.open('{{ route('uploads.download', ['filename' => $upload->file_path]) }}', '_blank')">Download</button>
                                    </td>
                                    @if(Auth::check() && Auth::user()->id == $upload->user_id)
                                        <td>
                                            <!-- Modify button for the logged-in user -->
                                            <button class="btn btn-success">Modify</button>
                                        </td>
                                        <td>
                                            <!-- Delete button for the logged-in user -->
                                            <button class="btn btn-danger">Delete</button>
                                        </td>
                                    @else
                                        <td></td>
                                        <td></td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger">No files available!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!--     <div class="row">
        <div class="col-8">
            Click on a file to view it!
        </div>
        <div class="col-4">
            <a href="{{ route('upload.create')}}" class="btn btn-primary">Add</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Our files</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($uploads as $upload)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <p>{{ $upload->hasUser->name }}</p>
                                <p> {{ $upload->title }} </p>
                                 <a href="{{ route('uploads.download', ['filename' => $upload->file_path]) }}" target="_blank"> DOWNLOAD </a>
                                <button class="btn btn-primary" onclick="window.open('{{ route('uploads.download', ['filename' => $upload->file_path]) }}', '_blank')">DOWNLOAD</button>
                            </li>
                        @empty
                            <li class="list-group-item text-danger">No files available!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div> -->

@endsection