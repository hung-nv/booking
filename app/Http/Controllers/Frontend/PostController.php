<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
	public function __construct() {
	    parent::__construct();
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    return view('article.index');
    }

    public function details()
    {
        return view('article.details');
    }
}
