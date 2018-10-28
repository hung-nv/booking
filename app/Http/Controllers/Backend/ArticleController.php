<?php

namespace App\Http\Controllers\Backend;

use App\Services\ArticleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    private $articleServices;

    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();
        $this->articleServices = $articleServices;
    }

    /**
     * Show all posts in paginate.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $dataPosts = $this->articleServices->getIndexPosts($request->all(), $this->postType);

        return view('backend.post.index', [
            'posts' => $dataPosts['posts'],
            'name' => $dataPosts['name']
        ]);
    }

    /**
     * Create post.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function create(Request $request)
    {
        $templateCategory = $this->articleServices->getCheckboxCategory(
            $this->categoryType,
            $request->old('parent')
        );

        $name = $request->old('name') ? $request->old('name') : '';
        $slug = $request->old('slug') ? $request->old('slug') : '';

        return view('backend.post.create', [
            'templateCategory' => $templateCategory,
            'name' => $name,
            'slug' => $slug
        ]);
    }

    /**
     * Store post.
     * @param PostStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PostStore $request)
    {
        $response = $this->articleServices->createPost($request, $this->postType);

        return redirect()->route('post.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Edit post.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function edit(Request $request, $id)
    {
        try {
            $dataPost = $this->articleServices->getPostInformationById($request, $id);

            $templateCategory = $this->articleServices->getCheckboxCategory(
                $this->categoryType,
                $dataPost['post_category']
            );

            return view('backend.post.update', [
                'templateCategory' => $templateCategory,
                'post' => $dataPost['post'],
                'name' => $dataPost['name'],
                'slug' => $dataPost['slug']
            ]);
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

    /**
     * Update post by id.
     * @param PostUpdate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(PostUpdate $request, $id)
    {
        $response = $this->articleServices->updatePost($request, $id);

        return redirect()->route('post.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Delete post by id.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->articleServices->deletePost($id);

        return redirect()->route('post.index')->with([
            'success' => $response
        ]);
    }
}
