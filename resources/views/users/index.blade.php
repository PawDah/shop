@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helpers.flash-messages')
        <div class="col-6">
            <h1><i class="fa-solid fa-user-group"></i> Lista Użytkowników</h1>
        </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">E-mail</th>
            <th scope="col">Imię</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">Numer Telefonu</th>
            <th scope="col">Akcje</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->email}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->phone_number}}</td>
            <td>
                <button class="btn delete btn-danger btn-sm" data-id="{{$user->id}}"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </table>

        {{ $users->links() }}
    <div/>
@endsection
@section('javascript')
           const deleteUrl="{{url('users')}}/";
@endsection
@section('js-files')
            @vite('resources/js/delete.js');
@endsection
