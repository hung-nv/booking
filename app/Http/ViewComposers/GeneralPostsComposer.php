<?php
namespace App\Http\ViewComposers;

use App\Models\Post;
use Illuminate\View\View;

class GeneralPostsComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */

    public function compose(View $view)
    {
        $generalPosts = Post::ofType(1)->orderByDesc('created_at')->limit(2)->get();
        $view->with('generalPosts', $generalPosts);
    }
}