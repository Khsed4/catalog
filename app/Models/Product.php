<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

    protected $fillable = [
        'name',
        'price',
        'SKU',
        'item_number',
        'description',
        'category_id',
        'catalogue_id',
        'image',
        'out_of_stock',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }
}
