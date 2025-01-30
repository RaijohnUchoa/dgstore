<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'slug',
        'image',
        'is_active',
    ];
    
    //Definir relacionamento com Produtos - BRAND contém vários produtos
    // public function products() {
    //     return $this->hasMany(Product::class);
    // }
}
