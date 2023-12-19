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
                        <div class="control-group col-12 mt-3">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') }}">
                            @error('nom')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group col-12 mt-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group col-12 mt-3">
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control" value="{{ old('adresse') }}">
                            @error('adresse')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="control-group col-12 mt-3">
                            <label for="ville_id">Ville</label>
                            <select id="ville_id" name="ville_id" class="form-control">
                                <option value="" {{ old('ville_id') ? '' : 'selected' }}>selectionez une ville</option>
                                @foreach($villes as $ville)
                                    <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                                @endforeach
                            </select>
                            @error('ville_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="control-group col-12 mt-3">
                            <label for="phone">Telephone</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                         <div class="control-group col-12 mt-3">
                            <label for="dob">date de naissance:</label>
                            <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob') }}">
                            @error('dob')
                                <span class="text-danger mt-8">{{ $message }}</span>
                            @enderror
                        </div>
                        

                    </div>
                    <div class="card-footer text-center d-grid">
                        <input type="submit" value="Sauvegarder" class="btn simple block btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection