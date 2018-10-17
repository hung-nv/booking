<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Services\ProductServices;

class HomepageController extends Controller
{
    private $productServices;

    public function __construct(ProductServices $productServices)
    {
        parent::__construct();

        $this->productServices = $productServices;
    }

    public function index()
    {
        $widgetCatalogs = [];

        $selectedCatalogs = [];

        if (!empty($this->option['mainCatalog'])) {
            $widgetCatalogs = $this->productServices->getWidgetCatalogsWithProducts($this->option['mainCatalog'], 8);
        }

        if (!empty($this->option['selectedCatalog'])) {
            $selectedCatalogs = $this->productServices->getWidgetCatalogsWithProducts($this->option['selectedCatalog'], 6);
        }

        return view('homepage.index', [
            'widgetCatalogs' => $widgetCatalogs,
            'selectedCatalogs' => $selectedCatalogs
        ]);
    }
}
