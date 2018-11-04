<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Option;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Define type.
     * @var
     */
    protected $postType,
        $categoryType,
        $pageType,
        $landingType;

    /**
     * Define option setting.
     * @var
     */
    protected $option;

    protected $mainMenu;

    public function __construct()
    {
        $this->setType();

        $this->getSettingSite();

//        $this->getMenu();
    }

    public function setType()
    {
        $this->categoryType = 1;
        $this->postType = 2;
        $this->pageType = 3;
        $this->landingType = 4;

        View::share('pageType', $this->pageType);

        View::share('landingType', $this->landingType);

        View::share('categoryType', $this->categoryType);
    }

    /**
     * Setting site.
     */
    public function getSettingSite()
    {
        if(request()->get('lang') and array_key_exists(request()->get('lang'), config('const.lang'))) {
            $lang = request()->get('lang');
        } else {
            $lang = config('const.lang.en.alias');
        }

        $this->option = Option::getConfigByLang($lang);

        View::share('option', $this->option);
    }

    /**
     * Get menu.
     */
    public function getMenu()
    {
        if (!empty($this->option['main_menu_id'])) {
            $mainMenu = $this->setMultiMenu(Menu::getMenuByGroup($this->option['main_menu_id'])->toArray());

            View::share('mainMenu', $mainMenu);
        }
    }

    /**
     * Set multi level menu.
     * @param $data
     * @return array
     */
    private function setMultiMenu($data)
    {
        $return = [];
        foreach ($data as $item) {
            $child = [];
            foreach ($data as $n => $i) {
                $grand = [];

                if ($i['parent_id'] == $item['id']) {
                    unset($data[$n]);
                    foreach ($data as $m => $j) {
                        if ($j['parent_id'] == $i['id']) {
                            $grand[] = $j;
                            unset($data[$m]);
                        }
                    }

                    if (isset($grand) && $grand) {
                        $i['grand'] = $grand;
                    }

                    $child[] = $i;
                }
            }

            if (empty($child) && $item['parent_id'] == null) {
                $return[] = $item;
            } else if (!empty($child)) {
                $item['child'] = $child;
                $return[] = $item;
            }

        }
        return $return;
    }
}
