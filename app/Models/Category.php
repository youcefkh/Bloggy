<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'name_ar',
    ];
    public function articles():HasManyThrough
    {
        return $this->hasManyThrough(Article::class, Subcategory::class);
    }
    public function subcategories():HasMany
    {
        return $this->hasMany(Subcategory::class);
    }
}
