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
                <strong>adresse: </strong>{!! $etudiant->adresse !!}
              </p>
              <p>
                <strong>email: </strong>{!! optional($etudiant->hasUser)->email !!}
              </p>
              <p>
                <strong>date de naissance: </strong>{!! $etudiant->dob !!}
              </p>
              <p>
                <strong>ville: </strong>{{ $etudiant->etudiantHasVille->nom }}
              </p>
              <p>
                  <strong>telephone: </strong> {{ $etudiant->phone }}
              </p>
            </div>
            <div class="row mt-5">
              <div class="col-3">
                  <a href="{{ route('user.edit', $etudiant->id)}}" class="btn simple">Modifier</a>
              </div>
              <div class="col-3">
                <a href="{{ route('etudiants.index')}}" class="btn simple">Retourner</a>
              </div>
              <div class="col-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn simple" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Effacer
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Effacer la donnée</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Etes-vous sûr de vouloir efffacer la donnée?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn simple" data-bs-dismiss="modal">Non</button>
        <form method="post" action="{{ route('user.delete', $user) }}">
            @csrf
            @method('delete')
            <input type="submit" value="Effacer" class="btn simple">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection