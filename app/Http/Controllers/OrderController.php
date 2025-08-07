<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $service) {}

    // initiate
    public function initiate(Request $request)
    {
        $order = $this->service->initiateOrder($request->user()->id);
        return response()->json($order);
    }

    // add Address
    public function addAddress(Request $request, Order $order)
    {
        $validated = $request->validate([
            'street' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        $order = $this->service->addAddress($order, $validated);
        return response()->json($order);
    }

    // add Payment
    public function addPayment(Request $request, Order $order)
    {
        $validated = $request->validate([
            'card_number' => 'required|digits:16',
            'expiry' => 'required|date_format:m/y'
        ]);

        $order = $this->service->addPayment($order, $validated);
        return response()->json($order);
    }

    // complete
    public function complete(Order $order)
    {
        $this->service->processAsync($order);
        return response()->json(['message' => 'Processing started']);
    }

    // cancel Order
    public function cancel(Request $request, Order $order)
    {
        $this->orderService->cancelOrder($order);
        return response()->noContent();
    }
}