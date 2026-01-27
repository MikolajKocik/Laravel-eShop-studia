<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\d]+$/'
            ],
        ], [
            'name.required' => 'Nazwa kategorii jest wymagana.',
            'name.regex' => 'Nazwa kategorii nie może zawierać cyfr.',
        ]);

        Category::create($validated);

        return redirect()->back()->with('message', 'Kategoria została dodana.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('message', 'Kategoria usunięta!');
    }
}
