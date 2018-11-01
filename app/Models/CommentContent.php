<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentContent extends Model
{
    protected $table = 'comment_content';

    public $timestamps = false;

    protected $fillable = [
        'lang',
        'name',
        'avatar',
        'content'
    ];
}
