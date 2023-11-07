<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use PHPUnit\Logging\Exception;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 *
 */
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
        return view('products.create',[
            'categories'=>ProductCategory::all()
    ]);

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
        return redirect(route('products.index'))->with('status','Produkt Dodany!');
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
            'product'=>$product,
            'categories'=>ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertProductRequest $request, Product $product): RedirectResponse
    {
        $oldImagePath = $product->image_path;
        $product->fill($request->validated());
        if ($request->hasFile('image')){
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
            $product->image_path=$request->file('image')->store('products');
        }

        $product->save();
        return redirect(route('products.index'))->with('status','Produkt Zaktualizowany!');;
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $product->delete();
            $request->session()->flash('status', 'Produkt Usunięty');
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

    /**
     * Download image of the specified resource in storage.
     * @param Product $product
     * @return RedirectResponse|StreamedResponse
     */
    public function downloadImage(Product $product): RedirectResponse|StreamedResponse
    {
        if (Storage::exists($product->image_path)) {
            return Storage::download($product->image_path, "$product->name.jpg");
        }

        return Redirect::back();
    }

}
