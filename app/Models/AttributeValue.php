<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends \Eloquent
{
    protected $table = 'attribute_values';

    protected $fillable = ['attr_value', 'attribute_id'];

    /**
     * Define relationship belongsToMany.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products() {
        return $this->belongsToMany('App\Models\Product', 'product_attribute_value');
    }

    /**
     * Define relationship belongsTo.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute() {
        return $this->belongsTo('App\Models\Attribute');
    }
}
