<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\ValueObjects\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 *
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            return view('orders.index',[
                'orders'=>Order::paginate(10)
            ]);
        }
        else{
            return view('orders.index',[
                'orders'=>Order::where('user_id',Auth::id())->paginate(10)
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     * @return RedirectResponse
     */
    public function store() : RedirectResponse
    {
        $cart = Session::get('cart',new Cart());
        if($cart->hasItems()){
            $order = new Order();
            $order->quantity = $cart->getQuantity();
            $order->price = $cart->getSum();
            $order->user_id = Auth::id();
            $order->save();
            $products =$cart->getItems()->map(function ($item){
                return [$item->getProductId()=>$item->getQuantity()] ;
            });
            $data=$products->mapWithKeys(function ($value){
                return [key($value) => ['product_quantity'=>$value[key($value)]]];
            });
            $order->products()->attach($data);
            Session::put('cart',new Cart());
            return redirect(route('orders.index'))->with('status','Zamówienie Zrealizowane!');
        }
            return back();
    }

}
