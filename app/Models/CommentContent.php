<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentContent extends \Eloquent
{
    protected $table = 'comment_content';

    public $timestamps = false;

    protected $fillable = [
        'lang',
        'name',
        'avatar',
        'content'
    ];

    public function scopeWithLang($query, $lang)
    {
        return $query->where('lang', $lang);
    }
}
