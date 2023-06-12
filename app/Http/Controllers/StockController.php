<?php

namespace App\Http\Controllers;

use App\Models\Ingridient;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $ingridients = Ingridient::all();
        return view('admin.stock.index', compact('ingridients'));
    }

    public function create()
    {
        return view('admin.stock.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $records = [];
        foreach ($data['name'] as $index => $name){
            $price = $data['price'][$index];
            $quantity = $data['quantity'][$index];

            $record = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
            ];
            $records[] = $record;
        }

        foreach ($records as $record) {
            Ingridient::create($record);
        }

        return redirect()->route('admin.stock')->with('status', "Продукт(ы) успешно добавлен(ы)");

    }

    public function delete($id)
    {
        $ingridient = Ingridient::findorfail($id);
        $ingridient->delete();
        //ToDo not delete
        return redirect()->route('admin.stock')->with('status', "Продукт {$ingridient->name} успешно удален");
    }
}
