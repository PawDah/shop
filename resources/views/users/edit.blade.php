@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edycja użytkownika</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update',$user->id) }}">
                            @method('PUT')
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Imię</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" maxlength="500" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="surname" class="col-md-4 col-form-label text-md-end">Nazwisko</label>
                                <div class="col-md-6">
                                    <input id="surname" type="text" maxlength="500" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{$user->surname}}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-end">Miasto</label>
                                <div class="col-md-6">
                                    <input id="city" type="text" maxlength="255" class="form-control @error('city') is-invalid @enderror" name="address[city]" value="@if($user->hasAddress()) {{$user->address->city}}@endif" required autocomplete="city" autofocus>

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="zip_code" class="col-md-4 col-form-label text-md-end">Kod pocztowy</label>
                                <div class="col-md-6">
                                    <input id="zip_code" type="text" maxlength="6" class="form-control @error('zip_code') is-invalid @enderror" name="address[zip_code]" value="@if($user->hasAddress()) {{$user->address->zip_code}}@endif" required autocomplete="zip_code" autofocus>

                                    @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="street" class="col-md-4 col-form-label text-md-end">Ulica</label>
                                <div class="col-md-6">
                                    <input id="street" type="text" maxlength="255" class="form-control @error('street') is-invalid @enderror" name="address[street]" value="@if($user->hasAddress()) {{$user->address->street}}@endif" required autocomplete="street" autofocus>

                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="street_no" class="col-md-4 col-form-label text-md-end">Numer Ulicy</label>
                                <div class="col-md-6">
                                    <input id="street_no" type="text" maxlength="6" class="form-control @error('street_no') is-invalid @enderror" name="address[street_no]" value="@if($user->hasAddress()) {{$user->address->street_no}}@endif" required autocomplete="street_no" autofocus>

                                    @error('street_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0 justify-content-center">
                                    <button type="submit" class="btn btn-primary col-md-3">
                                        Zapisz
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
