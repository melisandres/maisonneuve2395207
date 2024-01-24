@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="font-weight-bold text-light col-8">
            <h2 class="display-1">
                @lang('lang.article_index_heading')
            </h2>
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
                    <h4 class="text-muted">@lang('lang.article_index_subheading')</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($articles as $article)
                        <li><a href="{{ route('articles.show', $article->id)}}">{{ $article->title }}</a></li>
                        <p>@lang('lang.text_by') {{ $article->hasUser->name }}</p>
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