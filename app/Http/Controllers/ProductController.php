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
// Todo File upload.

        if ($product) {
            return redirect()->route('home')->with('status', "Продукт {$product->name} был успешно добавлен в меню!");
        } else {
            return redirect()->back()->with('warn', 'Oops, something went wrong. Please check the logs.')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = Product::where('id', $id)
            ->update(['price' => $data['price'], 'quantity' => $data['quantity']]);

        if ($product) {
            return redirect()->back()->with('status', "Продукт был успешно обновлен!");
        } else {
            return redirect()->back()->with('warn', 'Oops, something went wrong. Please check the logs.')->withInput();
        }

    }

    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $product = Product::where('id', $id)->update($data);

        if ($product) {
            return redirect()->back()->with('status', "Продукт $product->name был успешно изменен!");
        } else {
            return redirect()->back()->with('warn', 'Oops, something went wrong. Please check the logs.')->withInput();
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        Product::where('id', $id)->update(['on_sale' => 0, 'quantity' => 0]);

        return redirect()->back()->with('status', "Продукт $product->name был успешно удален" );
    }

}
