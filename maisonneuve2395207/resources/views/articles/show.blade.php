@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="col-12 pt-2">

<!--             <h4 class="display-1 text-light mt-2 d-inline">
                {{ $article->title }}
            </h4>
            <p class="d-inline text-light mt-2 mb-5">( {{ $article->updated_at }} )</p>
            <a href="{{ route('articles.index')}}" class="btn btn-outline-warning text-right mb-3 ">@lang('lang.text_return')</a> -->

            <div class="d-flex justify-content-between align-items-center">
              <div>
                  <h4 class="display-1 text-light d-inline mt-2">
                      {{ $article->title }}
                  </h4>
                  <p class="text-light d-inline mt-2 mb-5">
                      ( {{ $article->updated_at }} )
                  </p>
              </div>
              <a href="{{ route('articles.index')}}" class="btn btn-outline-warning mb-3">
                  @lang('lang.text_return')
              </a>
          </div>

            <hr class="text-light">
          
            <p class="display-5 text-light mt-2">
                <strong>@lang('lang.text_author'):</strong> {{ $article->hasUser?->name }}
            </p>
            <p class="text-light mt-5 mb-5">
              <!--if you want to show html formated text stored in the db, you execute the html with the following: -->
                {!! $article->text !!}
            </p>
        </div>
    </div>
    @can('update', $article)
      <div class="row">
          <div class="col-4">
            <a href="{{ route('articles.edit', $article->id)}}" class="btn btn-primary">@lang('lang.text_edit')</a>
          </div>
          <div class="col-4">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    @lang('lang.text_delete')
                  </button>
          </div>
      </div>
    @endcan



<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('lang.text_delete_heading')</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @lang('lang.text_delete_notification')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> @lang('lang.text_no')</button>
        <form method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="@lang('lang.text_delete')" class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection