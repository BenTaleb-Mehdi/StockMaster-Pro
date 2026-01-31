<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity', 'type', 'reason'];

    public function product() {
        return $this->belongsTo(products::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
