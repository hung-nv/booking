<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function products() {
        return $this->belongsToMany('App\Models\Product', 'product_tag');
    }
}
