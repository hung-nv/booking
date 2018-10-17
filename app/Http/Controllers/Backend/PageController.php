<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LandingStore;
use App\Http\Requests\LandingUpdate;
use App\Http\Requests\PostStore;
use App\Http\Requests\PostUpdate;
use App\Services\PostServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    private $postServices;

    public function __construct(PostServices $postServices)
    {
        parent::__construct();

        $this->postServices = $postServices;
    }

    /**
     * Show all pages.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pages = $this->postServices->getIndexPages([$this->pageType, $this->landingType]);

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
        $templateCategory = $this->postServices->getCheckboxCategory(
            $this->categoryType,
            $request->old('parent')
        );

        $name = $request->old('name') ? $request->old('name') : '';
        $slug = $request->old('slug') ? $request->old('slug') : '';

        return view('backend.page.create', [
            'templateCategory' => $templateCategory,
            'name' => $name,
            'slug' => $slug
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
        $response = $this->postServices->createPost($request, $this->pageType);

        return redirect()->route('page.index')->with([
            'success' => $response
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
        $templateCategory = $this->postServices->getCheckboxCategory(
            $this->categoryType,
            $request->old('parent')
        );

        $name = $request->old('name') ? $request->old('name') : '';
        $slug = $request->old('slug') ? $request->old('slug') : '';

        return view('backend.page.landing', [
            'templateCategory' => $templateCategory,
            'name' => $name,
            'slug' => $slug
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
        $response = $this->postServices->createLandingPage($request, $this->landingType);

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
            $dataPost = $this->postServices->getPostInformationById($request, $id);

            $templateCategory = $this->postServices->getCheckboxCategory(
                $this->categoryType,
                $dataPost['post_category']
            );

            return view('backend.page.update', [
                'templateCategory' => $templateCategory,
                'post' => $dataPost['post'],
                'name' => $dataPost['name'],
                'slug' => $dataPost['slug']
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
        $response = $this->postServices->updatePost($request, $id, true);

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
            $dataPage = $this->postServices->getLandingInformationById($request, $id);

            $templateCategory = $this->postServices->getCheckboxCategory(
                $this->categoryType,
                $dataPage['post_category']
            );

            return view('backend.page.updateLanding', [
                'templateCategory' => $templateCategory,
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
        $response = $this->postServices->updateLanding($request, $id);

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
        $response = $this->postServices->deletePage($id, $this->landingType);

        return redirect()->route('page.index')->with([
            'success' => $response
        ]);
    }
}
