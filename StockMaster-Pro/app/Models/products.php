<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    // Hada kaye-khalli l-N+1 i-moute f l-asl dyalo
    protected $with = ['category', 'supplier'];

    protected $fillable = [
        'category_id', 'name', 'sku', 'quantity', 
        'price', 'image_path', 'min_stock', 'supplier_id'
    ];

    // Relation dyal l-Category
    public function category() {
        return $this->belongsTo(categories::class, 'category_id');
    }

    // Relation dyal l-Supplier
    public function supplier() {
        return $this->belongsTo(suppliers::class, 'supplier_id');
    }

    // Helper bach t-عرف wach khass techri sel3a
    public function isLowStock() {
        return $this->quantity <= $this->min_stock;
    }
}