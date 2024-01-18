@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="col-8">
            Click on an article to read it!
        </div>
        <div class="col-4">
            <a href="{{ route('articles.create')}}" class="btn btn-primary">Add</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Our articles</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($articles as $article)
                        <li><a href="{{ route('articles.show', $article->id)}}">{{ $article->title }}</a></li>
                        <p>{{ $article->hasUser->name }}</p>
                        @empty
                        <li class="text-danger">No articles available!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection