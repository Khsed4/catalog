<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;
    protected $table = "catalogues";

    protected $fillable = ['name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
