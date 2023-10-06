<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsManagerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application Products Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        return view('product_manager', compact('products'));
    }

    public function add_product(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = strtolower($request->input('tags'));
        $image = $request->input('image');
        $path = FileStore::img_store($request);

        Product::create([
            'name' => $name,
            'description' => $description,
            'tags' => $tags,
            'image' => json_decode($path->getContent())->path,
        ]);

        return redirect()->route('dashboard.products_manager')->with(
            'success',
            'Product added successfully.'
        );
    }

    public function delete_product($id)
    {   
        Product::where('id', $id)->delete();
        
        return redirect()->route('dashboard.products_manager')->with(
            'success',
            'Product deleted successfully.'
        );
    }

    public function batch_delete_products(Request $request)
    {
        $ids = $request->input('ids');
        Product::whereIn('id', $ids)->delete();

        return response()->json(['status' => 'success']);
    }

    public function update_product(Request $request, $id)
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

        return redirect()->route('dashboard.products_manager')->with(
            'success',
            'Product updated successfully.'
        );
    }
}
