<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    protected function createdAt(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A'));
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A'));
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
