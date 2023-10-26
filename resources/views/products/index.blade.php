@extends('layouts.app')

@section('content')
    <div class="container">
     @include('helpers.flash-messages')
        <div class="row">
        <div class="col-6">
            <h1>Lista Produktów</h1>

        </div>
            <div class="col-6">
                <a class="float-end" href="{{route('products.create')}}">
                <button type="button" class="btn btn-primary">Dodaj</button>
                </a>
            </div>
        </div>
        <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Opis</th>
                <th scope="col">Ilość</th>
                <th scope="col">Cena</th>
                <th scope="col">Kategoria</th>
                <th scope="col">Akcje</th>
            </tr>
            </thead>
            <tbody>

            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->amount}}</td>
                    <td>{{$product->price}}</td>
                    <td>@if($product->hasCategory()){{$product->category->name}}@endif</td>
                    <td>
                        <a href="{{route('products.show',$product->id)}}">
                            <button class="btn btn-success">
                                Podgląd
                            </button>
                        </a>
                        <a href="{{route('products.edit',$product->id)}}">
                            <button class="btn btn-info">
                                Edytuj
                            </button>
                        </a>
                        <button class="btn delete btn-danger" data-id="{{$product->id}}">Usuń</button>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $products->links() }}
        <div/>
        </div>
        @endsection
        @section('javascript')
            const deleteUrl="{{url('products')}}/";
        @endsection
        @section('js-files')
            @vite('resources/js/delete.js');
@endsection
