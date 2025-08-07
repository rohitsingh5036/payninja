<?php

namespace App\Services;

use App\Models\Order;
use App\Jobs\ProcessOrderJob;
use Illuminate\Support\Facades\DB;

class OrderService
{
    // INITIATE
    public function initiateOrder(int $userId): Order
    {
        return DB::transaction(function () use ($userId) {
            return Order::create([
                'user_id' => $userId ?? 0,
                'current_step' => 'initiate'
            ]);
        });
    }

    // ADDRESS STEP
    public function addAddress(Order $order, array $addressData): Order
    {
        return DB::transaction(function () use ($order, $addressData) {
            if ($order->current_step !== 'initiate') {
                throw new \Exception("Current step must be 'initiate'");
            }

            return $order->update([
                'address_data' => $addressData,
                'current_step' => 'address'
            ]);
        });
    }

    // PAYMENT STEP 
    public function addPayment(Order $order, array $paymentData): Order
    {
        return DB::transaction(function () use ($order, $paymentData) {
            if ($order->current_step !== 'address') {
                throw new \Exception("Current step must be 'address'");
            }

            return $order->update([
                'payment_data' => $paymentData,
                'current_step' => 'payment'
            ]);
        });
    }

      public function cancelOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $order->delete(); // Soft delete
        });
    }

    // ASYNC PROCESSING TRIGGER
    public function processAsync(Order $order): void
    {
        if ($order->current_step !== 'payment') {
            throw new \Exception("Current step must be 'payment'");
        }

        ProcessOrderJob::dispatch($order);
    }
}