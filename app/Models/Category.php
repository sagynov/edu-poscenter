<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable = [
      'parent_id',
      'slug',
    ];

    protected $casts = [
      'is_active' => 'boolean'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function translations()
    {
      return $this->hasMany(CategoryTranslation::class);
    }

    public function translation()
    {
      return $this->hasOne(CategoryTranslation::class)->where('lang_code', app()->getLocale());
    }
}
