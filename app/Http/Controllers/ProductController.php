<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PHPUnit\Logging\Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('products.index',[
            'products'=>Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('products.create');


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertProductRequest $request): RedirectResponse
    {

        $product=new Product($request->validated());
        if ($request->hasFile('image')){
            $product->image_path=$request->file('image')->store('products');
        }
        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',[
        'product'=>$product
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product):View
    {
        return view('products.edit',[
            'product'=>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertProductRequest $request, Product $product)
    {
        $product->fill($request->validated());
        if ($request->hasFile('image')){
            $product->image_path=$request->file('image')->store('products');
        }

        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json([
                'status'=>'succes'
            ]);
        }catch (Exception $e){
            return response()->json([
                'status'=>'error',
                'message'=>'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }

}
