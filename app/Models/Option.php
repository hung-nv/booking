<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends \Eloquent
{
    protected $table = 'options';

    protected $fillable = ['key', 'value'];

    public $timestamps = false;
}
