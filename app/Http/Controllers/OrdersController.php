<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RetailProduct;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $products = RetailProduct::all();
        return view('orders', compact('products'));
    }
}
