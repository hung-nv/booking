<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends \Eloquent
{
    protected $table = 'options';

    protected $fillable = ['key', 'value', 'lang'];

    public $timestamps = false;

    public static function findOptionByKeyAndLang($key, $lang)
    {
        return self::where('key', $key)
            ->where('lang', $lang)
            ->get()
            ->first();
    }
}
