<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends \Eloquent
{
    protected $table = 'menu_group';

    protected $fillable = ['name'];
}
