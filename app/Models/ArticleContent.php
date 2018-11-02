<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleContent extends \Eloquent
{
    const FILLABLE = [
        'lang',
        'name',
        'description',
        'content',
        'meta_title',
        'meta_description'
    ];

    protected $table = 'article_content';

    public $timestamps = false;

    protected $fillable = self::FILLABLE;

    /**
     * Define relationship belongsTo article.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    /**
     * Define relationship hasMany option filed.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany('App\Models\MetaField', 'article_content_id');
    }
}
