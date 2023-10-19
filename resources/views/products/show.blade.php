@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Podgląd produktu</div>

                    <div class="card-body">


                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nazwa</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" maxlength="500" class="form-control" name="name" value="{{$product->name}}" disabled>


                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Opis</label>

                                <div class="col-md-6">
                                    <textarea id="description" disabled maxlength="1500" type="text" class="form-control" name="description" >{{ $product->description }} </textarea>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="amount" class="col-md-4 col-form-label text-md-end">Ilość</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number" min="0" class="form-control " disabled name="amount" value="{{ $product->amount}}" >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">Cena</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" step="0.01" min="0" class="form-control"   name="price" value="{{ $product->price }}" disabled>
                                </div>
                            </div>
                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">Kategoria</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category_id" disabled>
                                    @if($product->hasCategory())
                                        <option value="">{{$product->category->name}}</option>
                                    @else
                                        <option>Brak</option>
                                    @endif


                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
