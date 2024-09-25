<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'title',
        'slug',
        'barcode',
        'sku',
        'car_model',
        'car_year',
        'car_color',
        'car_scale',
        'car_attribute',
        'stock',
        'images',
        'description',
        'price_normal',
        'price_sale',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale',
    ];
            
    protected $casts = [
        'images' => 'array',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

}
