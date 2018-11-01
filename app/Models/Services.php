<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends \Eloquent
{
    protected $table = 'services';

    protected $fillable = ['user_id', 'icon'];

    public function servicesContent()
    {
        return $this->hasMany('App\Models\ServicesContent', 'services_id');
    }
}
