<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
    'name',
    'slug',
    'description',
    'image',
    'price',
    'discounted_price',
    'stock',
    'is_active',
    'upc',
    'sku',
    'asin',
    'manufacturer',
    'moq',
    'meta_description',
    'meta_title',
    'meta_keywords',
    'meta_tags',
    'page_schemas',
    'category_id',
    'sub_category_id',
];
protected $casts = [
        'price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean',
        'moq' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function productimages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
