<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesContent extends \Eloquent
{
    protected $table = 'services_content';

    public $timestamps = false;

    protected $fillable = [
        'lang',
        'name'
    ];

    public function services()
    {
        return $this->belongsTo('App\Models\Services', 'services_id');
    }
}
