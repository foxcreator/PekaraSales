<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsServise
{
    public function dailyReports($day)
    {

        $productsSold = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->whereDate('carts.created_at', $day)
            ->groupBy('carts.product_id')
            ->select('products.name', 'products.price', DB::raw('SUM(carts.quantity) as total_sold'))
            ->get();
        $totalSales = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->whereDate('carts.created_at', $day)
            ->sum(DB::raw('products.price * carts.quantity'));

        return compact('productsSold', 'totalSales');
    }

    public function Reports($onDate, $toDate)
    {

        $productsSold = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->whereDate('carts.created_at','>=', $onDate)
            ->whereDate('carts.created_at','<=', $toDate)
            ->groupBy('carts.product_id')
            ->select('products.name', 'products.price', DB::raw('SUM(carts.quantity) as total_sold'))
            ->get();

        $totalSales = Cart::join('products', 'carts.product_id', '=', 'products.id')
            ->whereDate('carts.created_at','>=', $onDate)
            ->whereDate('carts.created_at','<=', $toDate)
            ->sum(DB::raw('products.price * carts.quantity'));

        return compact('productsSold', 'totalSales');
    }

}
