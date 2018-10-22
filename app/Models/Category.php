<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends \Eloquent
{
    protected $table = 'category';

    protected $fillable = ['slug', 'parent_id', 'system_link_type_id'];

    /**
     * Define relationship many to many with article.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article', 'article_category', 'category_id', 'article_id');
    }

    /**
     * Define relationship has one content with lang.
     * @param $lang
     * @return mixed
     */
    public function categoryContent($lang)
    {
        return $this->hasOne('App\Models\CategoryContent')->wherePivot('lang', $lang);
    }

    /**
     * Define relationship belongsTo category: one parent.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    /**
     * Define relationship hasMany: one parent - many child.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens() {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public static function getCategoryByType($type)
    {
        return self::where('system_link_type_id', $type)->get();
    }
}