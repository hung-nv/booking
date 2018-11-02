<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends \Eloquent
{
    const ISTAY_TYPE = 1;

    const ROOM_TYPE = 2;

    const FILLABLE = [
        'slug',
        'image',
        'price',
        'parent_id',
        'user_id',
        'system_link_type_id',
        'landing_type',
        'status'
    ];

    protected $table = 'articles';

    protected $fillable = self::FILLABLE;

    public function category()
    {
        return $this->belongsToMany(
            'App\Models\Category',
            'article_category',
            'article_id',
            'category_id'
        );
    }

    /**
     * Define relationship has one article content.
     * @return mixed
     */
    public function articleContent()
    {
        return $this->hasMany('App\Models\ArticleContent', 'article_id');
    }

    /**
     * Define relationship many to many: article - services.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany('App\Models\Services', 'article_services', 'article_id', 'services_id');
    }

    /**
     * Get all posts by name.
     * @param string $name
     * @param int $pageSize
     * @param int $postType
     * @return $this|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPostsByName($name, $pageSize, $postType)
    {
        $posts = self::where('system_link_type_id', $postType)->orderByDesc('created_at');

        if ($name !== '-1') {
            $posts = $posts->where('name', $name);
        }

        $posts = $posts->paginate($pageSize);

        return $posts;
    }

    /**
     * Get all pages.
     * @param array $type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllPages(array $type)
    {
        return self::select([
            'b.*',
            'a.id AS id_content',
            'a.name',
            'a.description',
            'a.content',
            'a.lang'
        ])
            ->from('article_content AS a')
            ->leftJoin('articles AS b', function ($join) {
                $join->on('a.article_id', '=', 'b.id');
            })
            ->whereIn('system_link_type_id', $type)
            ->orderByDesc('b.created_at')
            ->get()
            ->toArray();
    }

    public static function findOriginArticleById($articleId)
    {
        return self::select([
            'b.id',
            'a.name'
        ])
            ->from('article_content AS a')
            ->join('articles AS b', function ($join) {
                $join->on('a.article_id', '=', 'b.id');
            })
            ->where('b.id', $articleId)
            ->first();
    }

    public static function getArticleContentById($articleId)
    {
        return self::select([
            'a.*',
            'b.slug',
            'b.status'
        ])
            ->from('article_content AS a')
            ->join('articles AS b', function ($join) {
                $join->on('a.article_id', '=', 'b.id');
            })
            ->where('a.id', $articleId)
            ->first();
    }

    public static function getIstay($landingType)
    {
        return self::select()
            ->from('article_content AS a')
            ->join('articles AS b', function ($join) {
                $join->on('a.article_id', '=', 'b.id');
            })
            ->where('a.lang', config('const.lang.en.alias'))
            ->where('b.system_link_type_id', $landingType)
            ->where('b.landing_type', self::ISTAY_TYPE)
            ->get();
    }
}
