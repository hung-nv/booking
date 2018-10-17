<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Group;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
	protected $postServices;
	private $allCategory;
	private $groupHot;

	public function __construct(PostInterface $postServices) {
	    parent::__construct();

		$this->postServices = $postServices;
		$this->allCategory = DB::table('category')->get();
		$this->groupHot = Group::find(env('POST_GROUP_HOT'));
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
	    $category = Category::where('slug', $category)->first();
    	$posts = $this->postServices->getAllPostsByParentCategory($category->id, $this->allCategory);
	    $posts = $posts->paginate(10);

	    getAllParentsCategory($this->allCategory, $category->id, $parentsCategory);

	    return view('posts.index', [
		    'category' => $category,
		    'posts' => $posts,
		    'groupHot' => $this->groupHot,
		    'parentsCategory' => $parentsCategory
	    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($alias)
    {
        $post = Post::where('slug', $alias)->first();
	    return view('posts.details', [
		    'post' => $post,
		    'groupHot' => $this->groupHot
	    ]);
    }
}
