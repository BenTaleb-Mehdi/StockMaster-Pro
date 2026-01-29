<?php

namespace App\Services;

use App\Models\categories;
use Illuminate\Support\Str;

class CategoryService
{
public function getAll($search = null) {
    return categories::withCount('products')
        ->when($search, function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        })
        ->latest()
        ->get();
}

public function getAllCount() {
    return categories::count();
}

    public function store(array $data) {
        $data['slug'] = Str::slug($data['name']);
        return categories::create($data);
    }

    public function update($id, array $data) {
        $category = categories::findOrFail($id);
        if(isset($data['name'])) $data['slug'] = Str::slug($data['name']);
        return $category->update($data);
    }

    public function delete($id) {
        $category = categories::findOrFail($id);
        if($category->products()->count() > 0) return false;
        return $category->delete();
    }
}