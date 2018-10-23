<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    protected $table = 'category_content';

    protected $fillable = [
        'lang',
        'name',
        'category_id',
        'image',
        'icon',
        'meta_title',
        'meta_description',
        'status'
    ];

    /**
     * Define relationship belongsTo category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Find category content by id.
     * @param $id
     * @param $lang
     * @return CategoryContent|Model|null
     */
    public static function findCategoryContentById($id, $lang)
    {
        return self::where('id', $id)
            ->where('lang', $lang)
            ->first();
    }
}
