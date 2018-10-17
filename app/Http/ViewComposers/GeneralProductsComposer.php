<?php
namespace App\Http\ViewComposers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\Setting;

class GeneralProductsComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {
        $generalProducts = Product::orderByDesc('created_at')->limit(5)->get();
        $view->with('generalProducts', $generalProducts);
    }
}