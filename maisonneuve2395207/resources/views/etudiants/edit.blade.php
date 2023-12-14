@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="post">
                    @method('put')
                    @csrf
                    <div class="card-header display-6 text-center">
                            Modifier l'article
                    </div>
                    <div class="card-body">
                        <div class="control-group col-12">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="{{ $etudiant->nom}}">
                        </div>
                        <div class="control-group col-12">
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control" value="{{ $etudiant->adresse}}">
                        </div>
                        <div class="control-group col-12">
                            <label for="phone">Telephone</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ $etudiant->phone}}">
                        </div>
                        <div class="control-group col-12">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $etudiant->email}}">
                        </div>
                        <div class="control-group col-12">
                            <label for="dob">date de naissance:</label>
                            <input type="date" id="dob" name="dob" class="form-control" value="{{ $etudiant->dob}}">
                        </div>
                        <div class="control-group col-12">
                            <label for="ville">Ville</label>
                            <input type="text" id="ville" name="ville" class="form-control" value="{{ $etudiant->ville}}">
                        </div>
                    </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="Modifier" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection