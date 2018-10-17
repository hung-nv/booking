<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PostStore;
use App\Http\Requests\PostUpdate;
use App\Services\PostServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    private $postServices;

    public function __construct(PostServices $postServices)
    {
        parent::__construct();
        $this->postServices = $postServices;
    }

    /**
     * Show all posts in paginate.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $dataPosts = $this->postServices->getIndexPosts($request->all(), $this->postType);

        return view('backend.post.index', [
            'posts' => $dataPosts['posts'],
            'name' => $dataPosts['name'],
            'groups' => $dataPosts['groups']
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
        $templateCategory = $this->postServices->getCheckboxCategory(
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
        $response = $this->postServices->createPost($request, $this->postType);

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
            $dataPost = $this->postServices->getPostInformationById($request, $id);

            $templateCategory = $this->postServices->getCheckboxCategory(
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
        $response = $this->postServices->updatePost($request, $id);

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
        $response = $this->postServices->deletePost($id);

        return redirect()->route('post.index')->with([
            'success' => $response
        ]);
    }
}
