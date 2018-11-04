<?php

namespace App\Http\Controllers\Frontend;

use App\Services\ArticleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    private $articleServices;

    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();

        $this->articleServices = $articleServices;
    }

    public function index(Request $request)
    {
        $lang = $request->lang ? $request->lang : config('const.lang.en.alias');

        $istays = $this->articleServices->getAllIstayByLang($lang, $this->landingType);

        return view('article.index', compact('istays'));
    }
}
