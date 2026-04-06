<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'sv123_products';

protected $fillable = [
    'category_id',
    'name',
    'slug',
    'description',
    'price',
    'stock_quantity',
    'image_path',
    'status',
    'discount_percent'
];

public function category()
{
    return $this->belongsTo(Category::class);
}
}
