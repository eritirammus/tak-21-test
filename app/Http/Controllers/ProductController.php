<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Product/index', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Product/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255',
            'description' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'category_id' => 'required',
        ]);
        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image_path' => Storage::putFile('products', $request->file('image_path')),
            'category_id' => $request->input('category_id'),
        ]);

        return Inertia::render('Product/index', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|max:255',
            'description' => 'required',
            'image_path' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|nullable',
            'category_id' => 'required',
        ]);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->image_path = $request->input('image_path');
        $product->category_id = $request->input('category_id');

        if ($request->hasFile('image')) {
            Storage::delete($product->image_path);
            $product->image_path = Storage::putFile('products', $request->file('image'));
        }

        $product->save();

        return Inertia::render('product/index', [
            'products' => product::all(),
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }
}
