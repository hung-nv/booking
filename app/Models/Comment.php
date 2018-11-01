<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends \Eloquent
{
    protected $table = 'comment';

    protected $fillable = ['user_id'];

    /**
     * Define relationship hasMany: one comment - many comment content.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentContent()
    {
        return $this->hasMany('App\Models\CommentContent', 'comment_id');
    }

    /**
     * Get all comments.
     * @return array
     */
    public static function getAllComments()
    {
        return self::select([
            'a.*',
            'a.id AS id_content',
            'b.id',
            'b.created_at'
        ])
            ->from('comment_content AS a')
            ->leftJoin('comment AS b', function ($join) {
                $join->on('a.comment_id', '=', 'b.id');
            })
            ->get()
            ->toArray();
    }

    /**
     * @param $commentId
     * @return Model|null|static
     */
    public static function findOriginCommentById($commentId)
    {
        return self::select([
            'b.name',
            'a.id'
        ])
            ->from('comment AS a')
            ->join('comment_content AS b', function ($join) {
                $join->on('a.id', '=', 'b.comment_id');
                $join->where('b.lang', config('const.lang.en.alias'));
            })
            ->where('a.id', $commentId)
            ->first();
    }

    /**
     * @param $commentContentId
     * @return Model|null|static
     */
    public static function findCommentByCommentContentId($commentContentId)
    {
        return self::select('a.created_at', 'b.*')
            ->from('comment AS a')
            ->join('comment_content AS b', function ($join) {
                $join->on('a.id', '=', 'b.comment_id');
            })
            ->where('b.id', $commentContentId)
            ->first();
    }
}
