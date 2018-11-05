<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends \Eloquent
{
    protected $table = 'contact';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'note',
        'content'
    ];

    public $timestamps = false;
}
