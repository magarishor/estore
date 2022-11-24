<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'summary',
        'price',
        'discounted_price',
        'images',
        'status',
        'featured',
        'category_id',
        'brand_id',
    ];

    protected $casts = [
        'images' => 'array'
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A'));
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A'));
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => json_decode($attributes['images'], true)[0]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
