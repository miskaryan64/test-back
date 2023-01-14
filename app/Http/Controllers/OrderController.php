<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->sortBy ? $request->sortBy : 'id';
        $sortDirection = $request->sortDirection ? $request->sortDirection : 'desc';

        $orders = Order::orderBy($sortBy, $sortDirection)->paginate(Order::PER_PAGE);

        return OrderResource::collection($orders);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'weight' => $request->weight,
            'total_price' => $request->total_price
        ]);

        return new OrderResource($order);
    }

    public function update(Request $request, Order $order)
    {
        $order->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'weight' => $request->weight,
            'total_price' => $request->total_price
        ]);

        return new OrderResource($order);
    }
}
