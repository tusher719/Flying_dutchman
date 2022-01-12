<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['qunatity', 'color_id', 'size_id', ];

    public function relation_to_products() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
