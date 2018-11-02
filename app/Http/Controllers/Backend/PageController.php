<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LandingStore;
use App\Http\Requests\LandingUpdate;
use App\Http\Requests\PostStore;
use App\Http\Requests\PostUpdate;
use App\Services\ArticleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    private $articleServices;

    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();

        $this->articleServices = $articleServices;
    }

    /**
     * Show all pages.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pages = $this->articleServices->getIndexPages([$this->pageType, $this->landingType]);

        return view('backend.page.index', [
            'pages' => $pages
        ]);
    }

    /**
     * Create page.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        // get origin category (english version)
        $originArticle = $this->articleServices->getCurrentPage($request->all());

        if (!(empty($request->all()) || ($request->has(['lang', 'article_id']) && $originArticle))) {
            abort(404);
        }

        $name = $request->old('name') ? $request->old('name') : '';
        $slug = $request->old('slug') ? $request->old('slug') : '';
        $lang = $request->lang ? $request->lang : 'en';

        return view('backend.page.create', [
            'originArticle' => $originArticle,
            'name' => $name,
            'slug' => $slug,
            'lang' => $lang
        ]);
    }

    /**
     * Store page.
     * @param PostStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PostStore $request)
    {
        $response = $this->articleServices->createArticle($request, $this->pageType);

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }

    public function room(Request $request)
    {
        // get origin category (english version)
        $originArticle = $this->articleServices->getCurrentPage($request->all());

        if (!(empty($request->all()) || ($request->has(['lang', 'article_id']) && $originArticle))) {
            abort(404);
        }

        $name = $request->old('name') ? $request->old('name') : '';

        $slug = $request->old('slug') ? $request->old('slug') : '';

        $lang = $request->lang ? $request->lang : 'en';

        return view('backend.page.room', [
            'name' => $name,
            'slug' => $slug,
            'lang' => $lang,
            'originArticle' => $originArticle
        ]);
    }

    /**
     * Create landing page.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function landing(Request $request)
    {
        // get origin category (english version)
        $originArticle = $this->articleServices->getCurrentPage($request->all());

        if (!(empty($request->all()) || ($request->has(['lang', 'article_id']) && $originArticle))) {
            abort(404);
        }

        $name = $request->old('name') ? $request->old('name') : '';

        $slug = $request->old('slug') ? $request->old('slug') : '';

        $lang = $request->lang ? $request->lang : 'en';

        $features = $request->old('services') ? $request->old('services') : [];

        $templateFeatures = $this->articleServices->getTemplateCheckboxServices($features, 'services');

        return view('backend.page.landing', [
            'name' => $name,
            'slug' => $slug,
            'lang' => $lang,
            'templateFeatures' => $templateFeatures,
            'originArticle' => $originArticle
        ]);
    }

    /**
     * Store landing page.
     * @param LandingStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function storeLanding(LandingStore $request)
    {
        $response = $this->articleServices->createIstay($request, $this->landingType);

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Edit page.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function edit(Request $request, $id)
    {
        try {
            $dataPost = $this->articleServices->getArticleInformationById($request, $id);

            return view('backend.page.update', [
                'article' => $dataPost['article'],
                'name' => $dataPost['name'],
                'slug' => $dataPost['slug'],
                'lang' => $dataPost['article']->lang
            ]);
        } catch (\Exception $exception) {
            return abort(403);
        }
    }

    /**
     * Update page.
     * @param PostUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(PostUpdate $request, $id)
    {
        $response = $this->articleServices->updatePost($request, $id, false);

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Edit landing.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function editLanding(Request $request, $id)
    {
        try {
            $dataPage = $this->articleServices->getLandingInformationById($request, $id);

            $templateFeatures = $this->articleServices->getTemplateCheckboxServices($dataPage['selectedServices'], 'services');

            return view('backend.page.updateLanding', [
                'templateFeatures' => $templateFeatures,
                'lang' => $dataPage['page']->lang,
                'page' => $dataPage['page'],
                'name' => $dataPage['name'],
                'slug' => $dataPage['slug'],
                'field' => $dataPage['dataLanding']
            ]);
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

    /**
     * Update landing page.
     * @param LandingUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function updateLanding(LandingUpdate $request, $id)
    {
        $response = $this->articleServices->updateLanding($request, $id);

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Delete page.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->articleServices->deletePage($id, $this->landingType);

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }
}
