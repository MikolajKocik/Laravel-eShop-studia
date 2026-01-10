<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:1'],
            'description' => ['required', 'string', 'min:30'],
        ], [
            'price.gt' => 'Cena musi być większa od 0.',
            'price.required' => 'Dodaj odpowiednią cenę.',
            'description.min' => 'Opis musi mieć co najmniej 30 znaków.',
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('message', 'Produkt został dodany.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:1'],
            'description' => ['required', 'string', 'min:30'],
        ], [
            'price.required' => 'Podaj cenę.',
            'price.numeric' => 'Cena musi być liczbą.',
            'price.min' => 'Cena musi wynosić co najmniej 1 zł.',
            'description.min' => 'Opis musi mieć co najmniej 30 znaków.',
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('message', 'Produkt został zaktualizowany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('message', "Produkt usunięto pomyślnie!")
            ->with('color', 'red');
    }
}
