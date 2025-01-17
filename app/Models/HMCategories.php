<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HMCategories extends Model
{
    use HasFactory;

    protected $table = 'hmcategories';

    protected $fillable = ['name', 'slug', 'icon'];

    protected $casts = [
        'icon' => 'array',
    ];

    public function restaurents()
    {
        return $this->belongsToMany(Restaurent::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
