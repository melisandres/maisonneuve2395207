@extends('layouts.layout')
@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-md-5 ">
            <div class="card">
                <div class="card-header text-center">
                    <h4 class="">Nos étudiants</h4>
                </div>
                <div class="card-body">
                    <ul>
                        @forelse($etudiants as $etudiant)
                        <li><a class="custom-link" href="{{ route('etudiants.show', $etudiant->id)}}">{{ $etudiant->hasUser->name }}</a></li>
                        @empty
                        <li class="text-danger">Aucun étudiant disponible !</li>
                        @endforelse
                    </ul>

                </div>
                <div class="card-footer text-center pt-4 ">
                    <ul class="pagination justify-content-center">
                    {{ $etudiants->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection