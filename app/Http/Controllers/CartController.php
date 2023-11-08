<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\ValueObjects\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use PHPUnit\Logging\Exception;

class CartController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        return view('cart.index',[
            'cart' => Session::get('cart',new Cart())
        ]);
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function store(Product $product): JsonResponse
    {
        $cart = Session::get('cart',new Cart());

        Session::put('cart',$cart->addItem($product));
        return response()->json([
            'status'=>'succes'
        ]);
    }

    /**
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Product $product, Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $cart = Session::get('cart',new Cart());
            Session::put('cart',$cart->removeItem($product));
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

}
