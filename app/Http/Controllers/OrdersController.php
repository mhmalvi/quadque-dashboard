<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrdersCollection;

class OrdersController extends Controller
{
    public function index()
    {
        return view('orders.index');
    }

    public function getAll()
    {
        try
        {
            return new OrdersCollection(
                Order::paginate(request('items'))
            );
        }
        catch(\Throwable $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
            ], 503);
        }
    }

    public function view(Order $order)
    {
        $order->load('details.product.category');
        $order->load('shipment.user');

        return view('orders.view_details', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => "required",
        ]);

        $order->update([
            'order_status' => $request->status,
        ]);

        return response()->json([
            'message' => "Successfully updated the status!",
        ], 200);
    }
}
