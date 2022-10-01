<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category_id', 'subcategory_id', 'childcategory_id', 'tax', 'tag', 'view', 'details', 'small_details', 'quantity', 'orginal_price', 'selling_price', 'image', 'status', 'trending', 'meta_title', 'meta_description', 'meta_keywords'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class)->withDefault();
    }

    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class)->withDefault();
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
