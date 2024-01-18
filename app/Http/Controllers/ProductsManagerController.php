<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProductsManagerController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products_manager', compact('products'));
    }

    public function add_product(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        $name = $validated['name'];
        $description = $validated['description'];
        $tags = strtolower($validated['tags']);
        $image = $validated['image'];
        $path = FileStore::img_store($request);

        Product::create([
            'name' => $name,
            'description' => $description,
            'tags' => $tags,
            'image' => json_decode($path->getContent())->path,
        ]);

        return Redirect::back()->with('success', 'Product added successfully.');
    }

    public function delete_product($id) : RedirectResponse
    {   
        Product::where('id', $id)->delete();
        return Redirect::back()->with('success', 'Product deleted successfully.');
    }

    public function batch_delete_products(Request $request)
    {
        $ids = $request->input('ids');
        Product::whereIn('id', $ids)->delete();

        return response()->json(['status' => 'success']);
    }

    public function update_product(Request $request, $id) : RedirectResponse
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = strtolower($request->input('tags'));

        $product = Product::find($id);

        if ($product->name != $name) {
            $product->name = $name;
        }
        if ($product->description != $description) {
            $product->description = $description;
        }
        if ($product->tags != $tags) {
            $product->tags = $tags;
        }
        if ($request->hasFile('image')) {
            $path = FileStore::img_store($request);
            $product->image = json_decode($path->getContent())->path;
        }

        $product->update();

        return Redirect::back()->with('success', 'Product updated successfully.');
    }
}
