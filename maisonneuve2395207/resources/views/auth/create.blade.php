@extends('layouts.layout')
@section('content')
 <main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 pt-4">
                <div class="card">
                    <h3 class="card-header text-center">
                        Enregistrer
                    </h3>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                        <form action="{{route('user.store')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" class="form-control"name="name" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('name')}}
                                        </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="form-group mb-3">
                                    <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('email')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="control-group col-12 mt-3">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" id="adresse" name="adresse" class="form-control" value="{{ old('adresse') }}">
                                    @error('adresse')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="control-group col-12 mt-3">
                                    <label for="ville_id">Ville</label>
                                    <select id="ville_id" name="ville_id" class="form-control">
                                        <option value=" {{ old('ville_id') ? '' : 'selected' }}">selectionez une ville</option>
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
                                    <input id="dob" name="dob" class="form-control" value="{{ old('dob') }}" placeholder="dd-mm-yyyy" >
                                    @error('dob')
                                        <span class="text-danger mt-8">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="control-group col-12 mt-3">
                                    <label for="password">password:</label>
                                    <input type="password" id="password" name="password">
                                    @error('password')
                                        <span class="text-danger mt-8">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="control-group col-12 mt-3">
                                    <label for="confirmation-password">confirm password:</label>
                                    <input type="password" id="confirmation-password" name="confirmation-password">
                                    @error('confirmation-password')
                                        <span class="text-danger mt-8">{{ $message }}</span>
                                    @enderror
                                </div>
                            <div class="d-grid mx-auto">
                                <input type="submit" value="Sauvegarder" class="btn btn-dark btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </main>
@endsection