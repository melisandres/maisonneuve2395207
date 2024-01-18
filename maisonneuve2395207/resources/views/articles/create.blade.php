@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <form  method="post">
                    @csrf
                    <div class="card-header display-6 text-center">
                            Ajouter un article
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="control-group col-6">
                                <label for="title">Title (en)</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group col-6">
                                <label for="title_fr">Titre (fr)</label>
                                <input type="text" id="title_fr" name="title_fr" class="form-control" value="{{ old('title_fr') }}">
                                @error('title_fr')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group col-6">
                                <label for="body">Article (en)</label>
                                <textarea id="text" name="text" class="form-control custom-textarea">{!! old('text') !!}</textarea>
                                @error('text')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group col-6">
                                <label for="body">Article (fr)</label>
                                <textarea id="text_fr" name="text_fr" class="form-control custom-textarea">{!! old('text') !!}</textarea>
                                @error('text_fr')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="Sauvegarder" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection