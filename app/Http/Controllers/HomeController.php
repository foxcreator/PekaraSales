<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\ReportsServise;
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
    public function __construct(ReportsServise $reportsServise)
    {
        $this->reportService = $reportsServise;
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
            $products = Product::where('on_sale', 1)->paginate(8);
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

    public function todayReport()
    {
        $today = Carbon::today();
        $reportData = $this->reportService->dailyReports($today);

        $productsSold = $reportData['productsSold'];
        $totalSales = $reportData['totalSales'];

        return view('admin.reports.index', compact('productsSold', 'totalSales'));
    }

    public function yesterdayReport()
    {
        $yesterday = Carbon::yesterday();
        $reportData = $this->reportService->dailyReports($yesterday);

        $productsSold = $reportData['productsSold'];
        $totalSales = $reportData['totalSales'];

        return view('admin.reports.yesterday', compact('productsSold', 'totalSales'));
    }

    public function monthlyReport(Request $request)
    {
        return view('admin.reports.monthly');
    }

    public function calcMonthlyReport(Request $request)
    {
        $dates = $request->all();
        if (empty($dates)) {
            $dates = [
                'ondate' => Carbon::now()->startOfMonth()->format('Y-m-d'),
                'todate' => Carbon::today()->format('Y-m-d')
            ];
        }

        $reportData = $this->reportService->Reports($dates['ondate'], $dates['todate']);
        $productsSold = $reportData['productsSold'];
        $totalSales = $reportData['totalSales'];

        return view('admin.reports.monthly', compact('productsSold', 'totalSales', 'dates'));
    }

}
