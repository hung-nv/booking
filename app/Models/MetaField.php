<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaField extends \Eloquent
{
    protected $table = 'meta_field';

    public $timestamps = false;

    protected $fillable = ['key_name', 'key_value', 'article_id'];

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'article_id');
    }

    /**
     * Get data landing page by page id.
     * @param $pageId
     * @return \Illuminate\Support\Collection
     */
    public static function getDataLandingById($pageId)
    {
        return self::select(['key_name', 'key_value'])->where('article_id', $pageId)
            ->pluck('key_value', 'key_name');
    }

    /**
     * Get Meta Field by ArticleId and KeyName.
     * @param $pageId
     * @param $keyName
     * @return MetaField|Model|null
     */
    public static function getFieldByArticleIdAndName($pageId, $keyName)
    {
        return self::where('article_id', $pageId)
            ->where('key_name', $keyName)
            ->first();
    }
}
