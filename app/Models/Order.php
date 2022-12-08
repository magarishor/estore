<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status'];

    protected function createdAt():Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A') );
    }

    protected function updatedAt():Attribute
    {
        return Attribute::get(fn($value) => Carbon::parse($value)->format('j M Y h:i A') );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
