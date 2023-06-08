<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_fr',
        'question_ar',
        'response_fr',
        'response_ar',
        'article_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
