<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image', 'status', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function childcategories()
    {
        return $this->hasMany(ChildCategory::class, 'subcategory_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id', 'id');
    }
}
