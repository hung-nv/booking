<?php

namespace App\Services;

use App\Models\SystemLinkType;

class BaseServices
{
    protected $configLink;

    public function __construct()
    {
        $this->configLink = SystemLinkType::all()->pluck('prefix', 'id');
    }
}