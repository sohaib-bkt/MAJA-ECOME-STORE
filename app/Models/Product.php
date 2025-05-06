<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'image',
        'images',
        'description',
        'price',
        'price_before_discount',
        'is_active',
        'stock',
        'slug',
        'color',
    ];

    protected $casts = [
        'images' => 'array',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $originalSlug = $slug = Str::slug($product->name);
            $counter = 1;

            while (static::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $product->slug = $slug;
        });
    }
}
