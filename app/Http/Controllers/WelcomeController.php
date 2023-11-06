<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PHPUnit\Logging\Exception;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $filters= $request->query('filter');
        $paginate= $request->query('paginate') ?? 5;
        $sort= $request->query('sort');
        $query= Product::query();
        if(!is_null($sort)){
            if($sort=='Cena rosnąco'){
                $query->orderBy('price','ASC');
            }
            if($sort=='Cena malejąco'){
                $query->orderBy('price','DESC');
            }
            if($sort=='Nazwa A-Z'){
                $query->orderBy('name','ASC');
            }
            if($sort=='Nazwa Z-A'){
                $query->orderBy('name','DESC');
            }
            if(is_null($filters)){
                return response()->json($query->paginate($paginate));
            }
        }
        if(!is_null($filters)){
            if (array_key_exists('categories',$filters)){
                $query=$query->whereIn('category_id',$filters['categories']);
            }
            if(!is_null($filters['price_min'])){
                $query=$query->where('price','>=',$filters['price_min']);
            }

            if(!is_null($filters['price_max'])){
                $query=$query->where('price','<=',$filters['price_max']);
            }

            return response()->json($query->paginate($paginate));
        }


        return view('welcome', [
            'products' =>  $query->paginate($paginate),
            'categories' => ProductCategory::orderBy('name','ASC')->get(),
            'defaultImage'=> config('shop.defaultImage'),
            'isGuest' => Auth::guest()
        ]);
    }

}
