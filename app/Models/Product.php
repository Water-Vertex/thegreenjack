<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
        'focus_keyword',
        'type',  
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean',
        'moq' => 'integer',
    ];

    // Product Type Accessors
    public function getTypeBadgeAttribute()
    {
        return match($this->type) {
            'featured' => '<span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800"><i class="fas fa-star mr-1"></i>Featured</span>',
            'best_seller' => '<span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800"><i class="fas fa-trophy mr-1"></i>Best Seller</span>',
            default => null,
        };
    }

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