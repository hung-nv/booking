<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SettingRequest;
use App\Services\Common\ImageServices;
use App\Services\MenuServices;
use App\Services\OptionServices;
use App\Services\PostServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    protected $image, $menuServices, $optionServices, $postServices;

    public function __construct(
        ImageServices $imageServices,
        MenuServices $menuServices,
        OptionServices $optionServices,
        PostServices $postServices
    )
    {
        parent::__construct();

        $this->image = $imageServices;

        $this->menuServices = $menuServices;

        $this->optionServices = $optionServices;

        $this->postServices = $postServices;
    }

    /**
     * Setting menu.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function menu(Request $request)
    {
        $idGroup = $request->menu_group;

        $data = $this->menuServices->getDataMenu($this->pageType, $idGroup);

        $templateCategory = $this->menuServices->getCheckboxAllCategory(
            $request->old('parent')
        );

        return view('backend.menu.index', [
            'templateCategory' => $templateCategory,
            'pages' => $data['pages'],
            'templateMenu' => $data['templateMenu'],
            'menuGroups' => $data['menuGroups']
        ]);
    }

    /**
     * Page index setting.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $dataSetting = $this->optionServices->getDataSetting($this->landingType);

        $checkedCatalog = isset($dataSetting['options']['mainCatalog']) ?
            explode(',', $dataSetting['options']['mainCatalog']) : $request->old('mainCatalog');

        $templateCatalog = $this->postServices->getCheckboxCategory(
            $this->catalogType,
            $checkedCatalog
        );

        $checkedSubCatalog = isset($dataSetting['options']['selectedCatalog']) ?
            explode(',', $dataSetting['options']['selectedCatalog']) : $request->old('selectedCatalog');

        $templateSubCatalog = $this->postServices->getCheckboxCategory(
            $this->catalogType,
            $checkedSubCatalog,
            'selectedCatalog'
        );

        return view('backend.theme.setting', [
            'option' => $dataSetting['options'],
            'pages' => $dataSetting['pages'],
            'menus' => $dataSetting['menus'],
            'templateCatalog' => $templateCatalog,
            'templateSubCatalog' => $templateSubCatalog
        ]);
    }

    /**
     * Save setting site.
     * @param SettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(SettingRequest $request)
    {
        $this->optionServices->saveSetting($request);

        return redirect()->route('setting.index')->with(['success' => 'Update successful']);
    }
}
