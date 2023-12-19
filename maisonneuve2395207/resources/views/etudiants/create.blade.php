@extends('layouts.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form  method="post">
                    @csrf
                    <div class="card-header display-6 text-center">
                            Ajouter un etudiant
                    </div>
                    <div class="card-body">
                        <div class="control-group col-12">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control">
                            @error('nom')
                                <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group col-12">
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control">
                            @error('adresse')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group col-12">
                            <label for="phone">Telephone</label>
                            <input type="text" id="phone" name="phone" class="form-control">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group col-12">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group col-12">
                            <label for="dob">date de naissance:</label>
                            <input type="date" id="dob" name="dob" class="form-control">
                            @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group col-12">
                            <label for="ville_id">Ville</label>
                            <select id="ville_id" name="ville_id" class="form-control">
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                @endforeach
                                @error('ville_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
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