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

    public static function getConfigByLang($lang)
    {
        return self::where('lang', $lang)
            ->orWhere('key', 'LIKE', '%background%')
            ->orWhere('key', 'LIKE', '%logo%')
            ->get()
            ->pluck('value', 'key');
    }
}
