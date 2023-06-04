<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);


        $search = $request->input('search');
        if ($search) {
            $products = Product::where('name', 'LIKE', '%' . $search . '%')->paginate(8);
        } else {
            $products = Product::paginate(8);
        }


        return view('home', compact('products', 'search', 'cart'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function products()
    {
        $products = Product::all();

        return view('admin.products', compact('products'));
    }

}
