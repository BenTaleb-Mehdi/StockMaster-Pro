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

    public function getHistory($categoryId = '', $search = '') {
        return StockAdjustment::with(['product', 'user'])
            ->when($categoryId, function($query) use ($categoryId) {
                $query->whereHas('product', function($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            })
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->whereHas('product', function($pq) use ($search) {
                        $pq->where('name', 'like', "%{$search}%");
                    })->orWhere('reason', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15);
    }
}