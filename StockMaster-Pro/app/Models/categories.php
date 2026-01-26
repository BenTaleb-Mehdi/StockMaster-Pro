<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = ['name', 'slug', 'image_path'];

    public function Product(){
        return $this->hasMany(products::class);
    }
}
