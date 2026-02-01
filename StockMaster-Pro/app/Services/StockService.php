<?php
namespace App\Services;

use App\Models\products;
use App\Models\StockAdjustment;
use Illuminate\Support\Facades\DB;

class StockService {
    public function adjust(int $productId, int $qty, string $type, string $reason) {
        return DB::transaction(function () use ($productId, $qty, $type, $reason) {
            $product = products::findOrFail($productId);

            if ($type === 'subtraction') {
                if ($product->quantity < $qty) {
                    throw new \Exception("Stock insuffisant!");
                }
                $product->decrement('quantity', $qty);
            } else {
                $product->increment('quantity', $qty);
            }

            return StockAdjustment::create([
                'product_id' => $productId,
                'user_id' => auth()->id(),
                'quantity' => $qty,
                'type' => $type,
                'reason' => $reason
            ]);
        });
    }

    public function getHistory() {
        return StockAdjustment::with(['product', 'user'])
            ->latest()
            ->paginate(15);
    }
}