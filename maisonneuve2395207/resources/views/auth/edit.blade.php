@extends('layouts.layout')
@section('content')
 <main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="card">
                    <h3 class="card-header text-center">
                        @lang('lang.student_edit_heading')
                    </h3>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif

                        <form action="{{ route('user.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <input type="text" placeholder="@lang('lang.text_name')" class="form-control"name="name" value="{{ old('name', $user->name) }}">
                                    @if ($errors->has('name'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('name')}}
                                        </div>
                                    @endif
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" placeholder="@lang('lang.text_email')" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-2">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif
                            </div>

                            <div class="control-group col-12 mt-3">
                                <input placeholder="@lang('lang.text_address')" id="adresse" name="adresse" class="form-control" value="{{ old('adresse', $etudiant->adresse) }}">
                                @error('adresse')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="control-group col-12 mt-3">
                                <select id="ville_id" name="ville_id" class="form-control">
                                    <option value="">@lang('lang.text_select_city')</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}"
                                        {{ old('ville_id', $etudiant->ville_id) == $ville->id ? 'selected' : '' }}>
                                        {{ $ville->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ville_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="control-group col-12 mt-3">
                                <input placeholder="@lang('lang.text_telephone')" id="phone" name="phone" class="form-control" value="{{ old('phone', $etudiant->phone) }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <hr>

                            <div class="control-group col-12 mt-3">
                                <label for="dob">@lang('lang.text_dob'):</label>
                                <input id="dob" name="dob" class="form-control" value="{{ old('dob', $etudiant->dob) }}" placeholder="yyyy-mm-dd" >
                                @error('dob')
                                    <span class="text-danger mt-8">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-center d-grid">
                            <input type="submit" value="@lang('lang.text_edit')" class="btn simple block btn-block">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
 </main>
@endsection