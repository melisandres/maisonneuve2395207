@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <form  method="post">
                    @method('put')
                    @csrf
                    <div class="card-header display-6 text-center">
                        @lang('lang.article_edit_heading')
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="control-group col-6">
                                <label for="title">@lang('lang.article_title_english')</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $article->title) }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group col-6">
                                <label for="title_fr">@lang('lang.article_title_french')</label>
                                <input type="text" id="title_fr" name="title_fr" class="form-control" value="{{ old('title_fr', $article->title_fr) }}">
                                @error('title_fr')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group col-6">
                                <label for="body">@lang('lang.article_english')</label>
                                <textarea id="text" name="text" class="form-control custom-textarea" rows="500">{!! old('text', $article->text) !!}</textarea>
                                @error('text')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group col-6">
                                <label for="body">@lang('lang.article_french')</label>
                                <textarea id="text_fr" name="text_fr" class="form-control custom-textarea" rows="500">{!! old('text_fr', $article->text_fr) !!}</textarea>
                                @error('text_fr')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="@lang('lang.text_save_caps')" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection