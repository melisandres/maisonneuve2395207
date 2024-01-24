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
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-muted">@lang('lang.article_index_subheading')</h4>
                </div>
                <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                        <tr>
                            <td><a href="{{ route('articles.show', $article->id)}}">{{ $article->title }}</a></td>
                            <td>@lang('lang.text_by') {{ $article->hasUser->name }}</td>
                            <td>{{ $article->updated_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-danger">@lang('lang.articles_none')</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                </div>
                <div class="card-footer pagination">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection