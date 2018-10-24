<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends \Eloquent
{
    protected $table = 'category';

    protected $fillable = ['slug', 'parent_id', 'system_link_type_id'];

    public $timestamps = false;

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
    public function categoryContent()
    {
        return $this->hasOne('App\Models\CategoryContent');
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

    /**
     * Get category by type.
     * @param $type
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getCategoryByType($type)
    {
        return self::where('system_link_type_id', $type)->get();
    }

    /**
     * Get category by lang.
     * @param $lang
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getCategoryByLang($lang)
    {
        $model = self::select('a.*', 'b.name')
            ->from('category AS a')
            ->join('category_content AS b', function ($join) use ($lang) {
                $join->on('a.id', '=', 'b.category_id');
                $join->where('b.lang', $lang);
            });

        if ($lang != 'en') {
            $model->leftJoin('category_content AS c', function ($join) use ($lang) {
                $join->on('a.id', '=', 'c.category_id');
                $join->where('c.lang', 'en');
            });
            $model->addSelect('c.name as originName');
        }

        return $model->get();
    }

    /**
     * Find category by categoryId and lang
     * @param int $categoryId
     * @param string $lang
     * @return Category|Model|null
     */
    public static function findCategoryById($categoryId, $lang)
    {
        return self::select('a.slug', 'a.parent_id', 'a.system_link_type_id', 'b.*')
            ->from('category AS a')
            ->join('category_content AS b', function ($join) use ($lang) {
                $join->on('a.id', '=', 'b.category_id');
                $join->where('b.lang', $lang);
            })
            ->where('a.id', $categoryId)
            ->first();
    }
}