<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price
            ];
        }

        session()->put('cart', $cart);

        if ($request->get('redirect') === 'products.index') {
            return redirect()->route('products.index')->with('message', 'Produkt dodany do koszyka!');
        }

        return redirect()->back()->with('message', 'Produkt dodany do koszyka!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('message', 'Koszyk zaktualizowany');
        }
    }

    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('message', 'Produkt został usunięty z koszyka!');
        }

        return redirect()->route('cart.index')->with('message', 'Produkt nie istnieje w koszyku.');
    }
}
