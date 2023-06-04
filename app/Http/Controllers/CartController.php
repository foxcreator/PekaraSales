<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->getTotal();

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {


        $cart = session()->get('cart', []);
        if (isset($cart[$product->id]['quantity']) && $cart[$product->id]['quantity'] > $product->quantity ){
            return redirect()->back()->with('error', "Невозможно добавить! Остаток - $product->quantity штук(и)");
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('home')->with('status', "Товар $product->name добавлен в чек");
    }

    public function checkout()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

//        dd($cart);
        foreach ($cart as $productId => $item) {
            $cartModel = Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
            ]);

            $cartId = $cartModel->id;

            // Уменьшаем количество товара на складе
            $product = Product::findOrFail($productId);
            $product->quantity -= $item['quantity'];
            $product->save();
        }

        session()->forget('cart');

        return redirect()->route('home')->with('status', "Чек #$cartId закрыт.");
    }

    public function remove(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            if ($cart[$product->id]['quantity'] > 1) {
                $cart[$product->id]['quantity']--;
            } else {
                unset($cart[$product->id]);
            }

            session()->put('cart', $cart);

            return redirect()->back()->with('status', "$product->name удален из чека");
        }

        return redirect()->back()->with('error', 'Товар не найден в чеке');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('home')->with('status', 'Корзина успешно очищена');
    }

    public function getTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }




}

