<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    protected $table = 'category_content';

    /**
     * Define relationship belongsTo category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
