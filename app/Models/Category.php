<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'slug',
        'image',
        'is_active',
    ];
    
    //Definir relacionamento com Produtos - CATEGORIA contém vários produtos
    // public function products() {
    //     return $this->hasMany(Product::class);
    // }

}

