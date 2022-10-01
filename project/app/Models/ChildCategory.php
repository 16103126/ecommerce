<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image', 'status', 'subcategory_id'
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class)->withDefault();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'childcategory_id', 'id');
    }
}
