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
}
