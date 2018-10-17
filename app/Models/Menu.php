<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends \Eloquent
{
    protected $table = 'menu';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'direct',
        'route',
        'menu_group_id',
        'sort',
        'prefix',
        'system_link_type_id'
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id');
    }

    public static function getMenuByGroup($idGroup)
    {
        return self::where('menu_group_id', $idGroup)->orderBy('sort')->get();
    }
}
