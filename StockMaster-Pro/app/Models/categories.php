<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class categories extends Model 
{
    protected $fillable = ['name', 'slug', 'image_path'];

    
    public function products(): HasMany
    {
        return $this->hasMany(products::class, 'category_id'); 
    }
}