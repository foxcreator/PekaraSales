<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->cartService->getTotal();

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $this->cartService->addProductToCart($product, $request->quantity);

        return redirect()->back();
    }

    public function checkout()
    {
        $cartId = $this->cartService->checkoutProductToDb();

        return redirect()->route('home')->with('status', "Чек #$cartId закрыт.");
    }

    public function remove(Request $request, Product $product)
    {
        $product->removeFromCart();

        return redirect()->back();
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('home')->with('status', 'Корзина успешно очищена');
    }

}

