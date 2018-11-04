<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            'b.image',
            'b.status'
        ])
            ->from('article_content AS a')
            ->join('articles AS b', function ($join) {
                $join->on('a.article_id', '=', 'b.id');
            })
            ->where('a.id', $articleId)
            ->first();
    }

    /**
     * Get all istay english version.
     * @param $systemLinkType
     * @param string $lang .
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getIstay($systemLinkType, $lang = null)
    {
        if (empty($lang)) {
            $lang = config('const.lang.en.alias');
        }

        return self::select([
            'a.name',
            'b.id',
            'b.image',
            'a.id AS id_content'
        ])
            ->from('article_content AS a')
            ->join('articles AS b', function ($join) {
                $join->on('a.article_id', '=', 'b.id');
            })
            ->where('a.lang', $lang)
            ->where('b.system_link_type_id', $systemLinkType)
            ->where('b.landing_type', self::ISTAY_TYPE)
            ->get();
    }

    /**
     * Find istay by id.
     * @param $istayId
     * @return bool
     */
    public static function findIstayById($istayId)
    {
        return self::where('id', $istayId)
            ->where('landing_type', self::ISTAY_TYPE)
            ->exists();
    }

    public static function getAllRooms($search)
    {
        $lang = !empty($search['lang']) ? $search['lang'] : config('const.lang.en.alias');

        $istays = self::select([
            'a.*',
            'b.image',
            'b.price',
            'b.slug',
            'c.name AS istay_name',
            'd.key_value AS address'
        ])
            ->from('article_content AS a')
            ->join('articles AS b', function ($join) {
                $join->on('a.article_id', '=', 'b.id');
            })
            ->leftJoin('article_content AS c', function ($join) {
                $join->on('c.article_id', '=', 'b.parent_id');
            })
            ->leftJoin('meta_field AS d', function ($join) {
                $join->on('d.article_content_id', '=', 'c.id');
                $join->where('key_name', '=', 'address');
            })
            ->where('a.lang', $lang)
            ->where('b.landing_type', self::ROOM_TYPE);

        // search with istay.
        if (!empty($search['where'])) {
            $istays->where('b.parent_id', $search['where']);
        }

        // search with min price
        if (!empty($search['min'])) {
            $istays->where('b.price', '>=', $search['min']);
        }

        // search with max price
        if (!empty($search['max'])) {
            $istays->where('b.price', '<=', $search['max']);
        }

        return $istays->paginate(9);
    }
}
