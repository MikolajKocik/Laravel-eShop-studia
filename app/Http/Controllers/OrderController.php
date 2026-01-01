<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store($productId)
    {
        $product = Product::findOrFail($productId);

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'total_price' => $product->price,
            'status' => 'Nowe'
        ]);

        return redirect()->back()-with('message', 'Dziękujemy za zakup!');
    }
}
