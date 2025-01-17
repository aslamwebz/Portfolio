<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'price', 'image_name', 'image_path', 'stock'];

    public function restaurents()
    {
        return $this->belongsToMany(Restaurent::class);
    }

    
}
