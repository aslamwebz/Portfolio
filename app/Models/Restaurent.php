<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurent extends Model
{
    protected $fillable = ['name', 'slug', 'address', 'phone', 'working_hours', 'image_name', 'image_path'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function categories()
    {
        return $this->belongsToMany(HMCategories::class);
    }
}
