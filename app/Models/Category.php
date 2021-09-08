<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $hidden = ['id'];
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getCreatedAtAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
