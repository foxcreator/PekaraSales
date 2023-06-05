<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
            $products = Product::where('on_sale', 1)->paginate(10);
        }


        return view('home', compact('products', 'search', 'cart'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function products()
    {
        $products = Product::where('on_sale', 1)->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function reports()
    {
        $today = Carbon::today();

        $productsSold = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->whereDate('carts.created_at', $today)
            ->groupBy('carts.product_id')
            ->select('products.name', 'products.price', DB::raw('SUM(carts.quantity) as total_sold'))
            ->get();
        $totalSales = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->whereDate('carts.created_at', $today)
            ->sum(DB::raw('products.price * carts.quantity'));

        return view('admin.reports.index', compact('productsSold', 'totalSales'));
    }

}
