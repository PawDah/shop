@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helpers.flash-messages')
        <div class="row">
            <div class="col-6">
                <h1><i class="fa-regular fa-rectangle-list"></i> Zamówienia </h1>
            </div>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ilość</th>
                    <th scope="col">Cena PLN</th>
                    <th scope="col">Produkty</th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $order)
                    <tr>
                        <td scope="row">{{$order->id}}</td>
                        <td scope="row">{{$order->quantity}}</td>
                        <td scope="row">{{$order->price}}</td>
                        <td scope="row">
                            <ul>
                        @foreach($order->products as $product)

                                <li>
                                {{$product->name}} - {{$product->description}}
                                </li>

                        @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </table>

            {{ $orders->links() }}
            <div/>
        </div>
 @endsection

