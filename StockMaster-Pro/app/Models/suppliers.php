<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    protected $fillable = [
        'name', 'phone', 'address'
    ];
    public function products(){
      return $this->hasMany(products::class, 'supplier_id');
    }

    
}
