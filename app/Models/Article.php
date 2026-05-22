<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
      'category_id',
      'slug',
    ];

    public function translations()
    {
      return $this->hasMany(ArticleTranslation::class);
    }

    public function translation()
    {
      return $this->hasOne(ArticleTranslation::class)->where('lang_code', app()->getLocale());
    }
}
