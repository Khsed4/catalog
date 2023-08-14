<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cataloge extends Model
{
    use HasFactory;
    protected $table = "cataloge";
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
