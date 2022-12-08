<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'order_id', 'rate', 'qty', 'total'];

    protected function createdAt():Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A') );
    }

    protected function updatedAt():Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A') );
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
