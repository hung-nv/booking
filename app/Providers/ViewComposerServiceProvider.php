<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeSidebarBackend();
        $this->composeFooter();
        $this->composeSidebarFrontend();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composeSidebarBackend()
    {

        View::composer(
            'backend.layouts.sidebar', 'App\Http\ViewComposers\SidebarComposer'
        );
    }

    private function composeFooter() {
        View::composer(
            'layouts.footer', 'App\Http\ViewComposers\InformationComposer'
        );
    }

    private function composeSidebarFrontend() {
        View::composer('layouts.sidebar', 'App\Http\ViewComposers\GeneralProductsComposer');
        View::composer('layouts.sidebar', 'App\Http\ViewComposers\GeneralPostsComposer');
    }
}
