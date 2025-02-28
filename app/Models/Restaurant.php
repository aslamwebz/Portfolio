<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'about_us',
        'slug',
        'address',
        'phone',
        'working_hours',
        'image',
    ];

    protected $casts = [
        'working_hours' => 'array',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(HMCategories::class)
            ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($restaurant) {
            if (empty($restaurant->slug)) {
                $restaurant->slug = Str::slug($restaurant->name);
            }
        });
    }
}
