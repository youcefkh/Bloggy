<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_ar',
        'category_id',
    ];
    public function articles():HasMany
    {
        return $this->hasMany(Article::class);
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}