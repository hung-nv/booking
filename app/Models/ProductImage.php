<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends \Eloquent
{
    protected $table = 'product_images';
    public $timestamps = false;

    protected $fillable = ['image'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
