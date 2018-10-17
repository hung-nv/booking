<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends \Eloquent
{
    protected $table = 'attributes';

    /**
     * Define relationship has many.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attribute_values() {
        return $this->hasMany('App\Models\AttributeValue');
    }
}
