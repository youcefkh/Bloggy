<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'article',
        'title_ar',
        'article_ar',
        'subcategory_id',
        'views',
        'status',
        'thumbnail_ar',
        'thumbnail_fr',
    ];
    public function subcategory():BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function faq()
    {
        return $this->hasOne(Faq::class);
    }

}
