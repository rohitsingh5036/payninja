<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Order $order) {}

    public function handle()
    {
        DB::transaction(function () {
            // STEP 1: Validate
            if ($this->order->current_step !== 'payment') {
                throw new \Exception("Invalid order state");
            }

            // STEP 2: Process payment (simulated)
            $this->order->update(['current_step' => 'processing']);
            sleep(2); // Mock payment processing

            // STEP 3: Finalize
            $this->order->update([
                'current_step' => 'completed',
                'total_amount' => $this->calculateTotal()
            ]);
        });
    }

    protected function calculateTotal(): float
    {
        return 109.99; // Mock total amount calculation
    }
}