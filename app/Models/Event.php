<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends \Eloquent
{
    protected $table = 'events';

    protected $fillable = ['name', 'description', 'start_at', 'end_at', 'status'];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getStartAtAttribute($value)
    {
        return date('Y/m/d H:i', strtotime($value));
    }

    public function getEndAtAttribute($value)
    {
        return date('Y/m/d H.i', strtotime($value));
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_event', 'event_id', 'product_id');
    }
}
