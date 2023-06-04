<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Services\FileStorageService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);


        if ($product) {
            return redirect()->route('home')->with('status', "Продукт {$product->name} был успешно добавлен в меню!");
        } else {
            return redirect()->back()->with('warn', 'Oops, something went wrong. Please check the logs.')->withInput();
        }
    }

}
