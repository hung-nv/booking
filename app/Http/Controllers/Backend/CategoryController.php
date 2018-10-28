<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdate;
use App\Services\CategoryServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    protected $categoryServices;

    public function __construct(CategoryServices $categoryServices)
    {
        parent::__construct();
        $this->categoryServices = $categoryServices;
    }

    /**
     * Get index category.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $category = $this->categoryServices->getIndexCategory($request);

        $lang = $request->lang ? $request->lang : 'en';

        return view('backend.category.index', [
            'category' => $category,
            'lang' => $lang
        ]);
    }

    /**
     * Create category.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        // get origin category (english version)
        $originCategory = $this->categoryServices->getCurrentCategory($request->all());

        if (!(empty($request->all()) || ($request->has(['lang', 'category_id']) && $originCategory))) {
            abort(404);
        }

        $lang = $request->lang ? $request->lang : 'en';

        $templateCategory = $this->categoryServices->getSelectCategory($request->old('parent_id'));

        return view('backend.category.create', [
            'templateCategory' => $templateCategory,
            'originCategory' => $originCategory,
            'lang' => $lang
        ]);
    }

    /**
     * Store category.
     * @param CategoryStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CategoryStore $request)
    {
        $response = $this->categoryServices->createCategory($request);

        return redirect()->route('category.index')->with([
            'success' => $response
        ]);
    }


    /**
     * Edit category.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function edit(Request $request, $id)
    {
        $information = $this->categoryServices->getInformationCategoryById($id);

        if (empty($information)) {
            abort(404);
        }

        return view('backend.category.update', [
            'category' => $information['category'],
            'templateCategory' => $information['templateSelectCategory'],
            'lang' => $information['category']->lang
        ]);
    }

    /**
     * Update category.
     * @param CategoryUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(CategoryUpdate $request, $id)
    {
        $response = $this->categoryServices->updateCategory($request, $id);

        return redirect()->route('category.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Delete category.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->categoryServices->deleteCategory($id);

        return redirect()->route('category.index')->with([
            'success' => $response
        ]);
    }
}
