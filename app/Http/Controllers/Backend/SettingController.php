<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SettingRequest;
use App\Services\ArticleServices;
use App\Services\Common\ImageServices;
use App\Services\MenuServices;
use App\Services\OptionServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    protected $image, $menuServices, $optionServices, $articleServices;

    public function __construct(
        ImageServices $imageServices,
        MenuServices $menuServices,
        OptionServices $optionServices,
        ArticleServices $articleServices
    )
    {
        parent::__construct();

        $this->image = $imageServices;

        $this->menuServices = $menuServices;

        $this->optionServices = $optionServices;

        $this->articleServices = $articleServices;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index()
    {
        $lang = config('const.lang.en.alias');

        $dataSetting = $this->optionServices->getDataSetting($lang);

        return view('backend.theme.setting', [
            'option' => $dataSetting['options'],
            'lang' => $lang
        ]);
    }

    public function korea()
    {
        $lang = config('const.lang.ko.alias');

        $dataSetting = $this->optionServices->getDataSetting($lang);

        return view('backend.theme.setting', [
            'option' => $dataSetting['options'],
            'lang' => $lang
        ]);
    }

    public function vietnam()
    {
        $lang = config('const.lang.vi.alias');

        $dataSetting = $this->optionServices->getDataSetting($lang);

        return view('backend.theme.setting', [
            'option' => $dataSetting['options'],
            'lang' => $lang
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
