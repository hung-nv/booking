<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends \Eloquent
{
    protected $table = 'articles';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'content',
        'user_id',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'system_link_type_id'
    ];

    public function category()
    {
        return $this->belongsToMany(
            'App\Models\Category',
            'article_category',
            'article_id',
            'category_id'
        );
    }

    public function fields()
    {
        return $this->hasMany('App\Models\MetaField', 'article_id');
    }

    public function groups()
    {
        return $this->belongsToMany(
            'App\Models\Group',
            'article_group',
            'article_id',
            'group_id'
        );
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H.i', strtotime($value));
    }

    /**
     * Get all posts by name.
     * @param string $name
     * @param int $pageSize
     * @param int $postType
     * @return $this|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getPostsByName(string $name, int $pageSize, int $postType)
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
        return self::whereIn('system_link_type_id', $type)->orderByDesc('created_at')->get();
    }
}
