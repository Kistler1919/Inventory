<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'code', 
        'root', 
        'purchase_price', 
        'retail_price', 
        'wholesale_price', 
        'purchase_date', 
        'image', 
        'quantity', 
        'category_id', 
        'supplier_id'
    ];
}
