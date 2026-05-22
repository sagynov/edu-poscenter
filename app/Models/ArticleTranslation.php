<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    protected $fillable = [
      'article_id',
      'lang_code',
      'title',
      'content'
    ];

    public function translation()
    {
      return $this->hasOne(ArticleTranslation::class);
    }
}
