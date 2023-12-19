@extends('layouts.layout')
@section('content')
    <div class="blue row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="post">
                    @method('put')
                    @csrf
                    <div class="card-header display-6 text-center">
                            Modifier les infos 
                    </div>
                    <div class="card-body container-fluid">
                        <div class="row">
                            <div class="control-group col-5">
                                <label for="nom">Nom</label>
                                <input type="text" id="nom" name="nom" class="form-control" value="{{ $etudiant->nom}}">
                                @error('nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group col-7">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $etudiant->email}}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>
                        <div class="row">
                            <div class="control-group col-8">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" name="adresse" class="form-control" value="{{ $etudiant->adresse}}">
                                @error('adresse')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group col-4">
                                <label for="ville_id">Ville</label>
                                <select id="ville_id" name="ville_id" class="form-control">
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}" @if($ville->id == $etudiant->ville_id) selected @endif>{{ $ville->nom }}</option>
                                    @endforeach
                                </select>
                                @error('ville_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group col-6">
                                <label for="phone">Telephone</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ $etudiant->phone}}">
                                @error('phone')
                                    <span class="callout-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="control-group col-6">
                                <label for="dob">date de naissance:</label>
                                <input type="date" id="dob" name="dob" class="form-control" value="{{ $etudiant->dob}}">
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" value="Modifier" class="btn btn-default">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection