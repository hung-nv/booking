<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleContent extends \Eloquent
{
    protected $table = 'article_content';

    public $timestamps = false;

    protected $fillable = [
        'lang',
        'name',
        'image',
        'description',
        'content',
        'meta_title',
        'meta_description'
    ];

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
