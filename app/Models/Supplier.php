<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'supplier_name',
        'contact',
        'image_logo',
        'cpf_cnpj',
        'phone',
        'street_address',
        'city',
        'state',
        'country',
        'zipcode',
        'is_active',
    ];
    
}
