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
    public function childrens()
    {
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
     * @param $exceptCategoryIds
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getCategoryByLang($lang, $exceptCategoryIds = [])
    {
        $model = self::select('a.*', 'b.name')
            ->from('category AS a')
            ->join('category_content AS b', function ($join) use ($lang) {
                $join->on('a.id', '=', 'b.category_id');
                $join->where('b.lang', $lang);
            });

        if ($exceptCategoryIds) {
            $model->whereNotIn('b.id', $exceptCategoryIds);
        }

        return $model->get();
    }

    /**
     * Get all category.
     * @return array
     */
    public static function getAllCategory()
    {
        return self::select([
            'b.id',
            'a.id as id_content',
            'a.lang',
            'a.name',
            'b.parent_id',
            'b.status',
            'b.slug'
        ])
            ->from('category_content AS a')
            ->leftJoin('category AS b', function ($join) {
                $join->on('a.category_id', '=', 'b.id');
            })
            ->get()->toArray();
    }

    /**
     * Find category by categoryId and lang
     * @param int $categoryContentId
     * @return Category|Model|null
     */
    public static function findCategoryById($categoryContentId)
    {
        return self::select('a.slug', 'a.parent_id', 'a.system_link_type_id', 'b.*')
            ->from('category AS a')
            ->join('category_content AS b', function ($join) {
                $join->on('a.id', '=', 'b.category_id');
            })
            ->where('b.id', $categoryContentId)
            ->first();
    }
}