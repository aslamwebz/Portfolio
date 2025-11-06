<?php

declare(strict_types=1);

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

    public function restaurants()
    {
        return $this->belongsToMany(restaurant::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
