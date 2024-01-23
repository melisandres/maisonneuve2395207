@extends('layouts.layout')
@section('content')

    <div class="row white-text">
        <div class="col-12 pt-2">
            <h4 class="display-6 mt-2">
                {{ $etudiant->nom }}
            </h4>
            <hr>
            <div class="">
              <h3>
              {!! optional($etudiant->hasUser)->name !!}
              </h3>
              <p>
                <strong>@lang('lang.text_address'): </strong>{!! $etudiant->adresse !!}
              </p>
              <p>
                <strong>@lang('lang.text_email'): </strong>{!! optional($etudiant->hasUser)->email !!}
              </p>
              <p>
                <strong>@lang('lang.text_dob'): </strong>{!! $etudiant->dob !!}
              </p>
              <p>
                <strong>@lang('lang.text_city'): </strong>{{ $etudiant->etudiantHasVille->nom }}
              </p>
              <p>
                  <strong>@lang('lang.text_telephone'): </strong> {{ $etudiant->phone }}
              </p>
            </div>
            <div class="row mt-5">
              <div class="col-3">
                  <a href="{{ route('user.edit', $etudiant->hasUser->id)}}" class="btn simple">@lang('lang.text_edit')</a>
              </div>
              <div class="col-3">
                <a href="{{ route('etudiants.index')}}" class="btn simple">@lang('lang.text_return')</a>
              </div>
              <div class="col-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn simple" data-bs-toggle="modal" data-bs-target="#deleteModal">
                @lang('lang.text_delete')
                </button>
              </div>
          </div>
        </div>
    </div>




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
        <button type="button" class="btn simple" data-bs-dismiss="modal">@lang('lang.text_no')</button>
        <form method="post" action="{{ route('user.delete', $user) }}">
            @csrf
            @method('delete')
            <input type="submit" value="@lang('lang.text_delete')" class="btn simple">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection