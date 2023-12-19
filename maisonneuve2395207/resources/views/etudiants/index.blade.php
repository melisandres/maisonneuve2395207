@extends('layouts.layout')
@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="">Nos étudiants</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($etudiants as $etudiant)
                        <li><a class="custom-link" href="{{ route('etudiants.show', $etudiant->id)}}">{{ $etudiant->nom }}</a></li>
                        @empty
                        <li class="text-danger">Aucun étudiant disponible !</li>
                        @endforelse
                    </ul>

                </div>
                <div class="card-footer text-center pt-4">
                    {{ $etudiants->links() }}
                </div>
            </div>
        </div>
    </div>


@endsection