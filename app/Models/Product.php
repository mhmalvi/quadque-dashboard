<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $hidden = ["id"];

    protected $guarded = [];

    public function getCreatedAtAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }

    public function getThumbnailAttribute($value)
    {
        return Storage::disk('ftp')->url("storage/products/{$value}");
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
