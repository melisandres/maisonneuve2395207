@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="col-8">
            @lang('lang.article_index_heading')
        </div>
        <div class="col-4">
            <a href="{{ route('articles.create')}}" class="btn btn-primary">@lang('lang.text_add_caps')</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('lang.article_index_subheading')</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($articles as $article)
                        <li><a href="{{ route('articles.show', $article->id)}}">{{ $article->title }}</a></li>
                        <p>{{ $article->hasUser->name }}</p>
                        @empty
                        <li class="text-danger">@lang('lang.articles_none')</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer pagination">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection