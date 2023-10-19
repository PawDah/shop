<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PHPUnit\Logging\Exception;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('welcome', [
            'products' => Product::paginate(10),
            'categories' =>ProductCategory::orderBy('name','ASC')->get()
        ]);
    }

}
