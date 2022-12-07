<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'rating', 'product_id', 'user_id'];

    protected function createdAt():Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A') );
    }

    protected function updatedAt():Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A') );
    }

    protected function reviewTime(): Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => Carbon::parse
        ( $attributes['created_at'])->diffForHumans());
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
