<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RetailProduct;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function place_order_view()
    {
        $products = RetailProduct::all();

        return view('place_orders', compact('products'));
    }

    public function place_order(Request $request)
    {
        $user_id = $request->user()->id;
        $total_order_value = 0;
        
        // Validate incoming request data
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products' => 'required|array|min:1', // Assuming you're passing items in the request
            'products.*.id' => 'required|exists:products,id',
            'products.*.qty' => 'required',
        ]);
        
        // Create the order
        $existingOrder = Order::where('client_id', $validatedData['client_id'])->whereDate('created_at', date('Y-m-d'))->first();
        if ($existingOrder) {
            $order = $existingOrder;
        } else {
            $order = Order::create([
                'user_id' => $user_id,
                'client_id' => $validatedData['client_id'],
            ]);
        }

        // Create order items
        foreach ($validatedData['products'] as $item) {
            $total_order_value += $item['qty'] * RetailProduct::find($item['id'])->unit_price;
            if (OrderItem::where('order_id', $order->id)->where('product_id', $item['id'])->exists()) {
                $orderItem = OrderItem::where('order_id', $order->id)->where('product_id', $item['id'])->first();
                $orderItem->update([
                    'qty' => $item['qty'],
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                continue;
            } else {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                ]);
            }
        }

        // Update total_order_value in the order
        $order->update([
            'total_order_value' => $total_order_value,
        ]);

        return redirect()->route('dashboard.place_orders')->with('success', 'Order placed successfully');
    }

    public function update_order_status(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::find($request->order_id);
        $order->update([
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('dashboard.manage_orders')->with('success', 'Order status updated successfully');
    }

    public function manage_orders_view()
    {
        $orders = Order::with('client')->get();

        return view('manage_orders', compact('orders'));
    }
}
