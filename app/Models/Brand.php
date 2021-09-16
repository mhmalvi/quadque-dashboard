<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['brand'] = ucfirst($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
