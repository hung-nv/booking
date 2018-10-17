<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends \Eloquent
{
    protected $table = 'category';

    protected $fillable = ['name', 'slug', 'parent_id', 'image', 'icon', 'meta_title', 'meta_description', 'system_link_type_id'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_category', 'category_id', 'article_id');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'product_category', 'category_id', 'product_id');
    }

    public function limitProduct() {
        return $this->belongsToMany('App\Models\Product', 'product_category', 'category_id', 'product_id')->limit(8);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function childrens() {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public static function getCategoryByType($type)
    {
        return self::where('system_link_type_id', $type)->get();
    }
}