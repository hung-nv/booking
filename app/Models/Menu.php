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

    /**
     * Define relationship belongsTo parent menu.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }

    /**
     * Define relationship one parent menu - many child.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id');
    }

    /**
     * Get menu by groupId.
     * @param int $idGroup
     * @return Menu[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getMenuByGroup($idGroup)
    {
        return self::where('menu_group_id', $idGroup)->orderBy('sort')->get();
    }
}
