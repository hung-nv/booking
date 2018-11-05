<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ArticleServices;
use App\Services\CommentServices;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    private $commentServices, $articleServices;

    public function __construct(CommentServices $commentServices, ArticleServices $articleServices)
    {
        parent::__construct();

        $this->commentServices = $commentServices;

        $this->articleServices = $articleServices;
    }

    public function index(Request $request)
    {
        $lang = $request->lang ? $request->lang : config('const.lang.en.alias');

        if (\App::getLocale() !== $lang) {
            \App::setLocale($lang);
        }

        $comments = $this->commentServices->getCommentsByLang($lang);

        $istays = $this->articleServices->getAllIstayByLang($lang, $this->landingType);

        return view('homepage.index', compact('comments', 'istays', 'lang'));
    }
}
