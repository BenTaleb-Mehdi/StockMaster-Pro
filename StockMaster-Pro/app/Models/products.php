<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'category_id', 'name', 'sku', 'quantity', 
        'price', 'image_path', 'min_stock', 'supplier_id'
    ];

    public function Category(){
        return $this->belongsTo(categories::class);
    }

    public function isLowStock(){
        return $this->quantity <= $this->min_stock;
    }

    public function supplier(){
        return $this->belongsTo(suppliers::class);
    }
}
