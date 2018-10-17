<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class AdminSiteController extends Controller
{
    public function index() {
        return view('backend.site.dashboard');
    }
}
