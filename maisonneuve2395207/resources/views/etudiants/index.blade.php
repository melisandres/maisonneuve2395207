@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="col-8">
            Cliquez sur un étudiant pour voire ses infos
        </div>
        <div class="col-4">
            <a href="{{ route('etudiants.create')}}" class="btn btn-primary">Ajouter</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lister les étudiants</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($etudiants as $etudiant)
                        <li><a href="{{ route('etudiants.show', $etudiant->id)}}">{{ $etudiant->nom }}</a></li>
                        @empty
                        <li class="text-danger">Aucun article disponible !</li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>
    </div>


@endsection