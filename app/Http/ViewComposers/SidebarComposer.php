<?php

namespace App\Http\ViewComposers;

use App\Models\MenuSystem;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;

class SidebarComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {
        $menuSystem = MenuSystem::where('status', '1')->orderBy('sort')->get();

        $sidebar = $this->setMultiMenu($menuSystem);

        $route = Route::current()->getAction();

        $view->with('sidebar', $sidebar);

        $view->with('routeName', $route['as']);
    }

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