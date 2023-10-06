<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;

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

        return response()->json([
            'status' => 'success',
            'message' => 'Product added successfully.'
        ]);
    }

    public function delete_product($id)
    {   
        Product::where('id', $id)->delete();
        
        return redirect()->route('dashboard.products_manager')->with(
            'success',
            'Product deleted successfully.'
        );
    }
}
