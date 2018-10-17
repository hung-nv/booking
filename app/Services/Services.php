<?php

namespace App\Services;

use App\Models\SystemLinkType;

class Services
{
    protected $configLink;

    public function __construct()
    {
        $this->configLink = SystemLinkType::all()->pluck('prefix', 'id');
    }
}