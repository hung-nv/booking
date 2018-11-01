<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CommentStore;
use App\Services\CommentServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    private $commentServices;

    public function __construct(CommentServices $commentServices)
    {
        parent::__construct();

        $this->commentServices = $commentServices;
    }

    public function index(Request $request)
    {
        $comments = $this->commentServices->getIndexComment();

        $lang = $request->lang ? $request->lang : 'en';

        return view('backend.comment.index', [
            'comments' => $comments,
            'lang' => $lang
        ]);
    }

    public function create(Request $request)
    {
        // get origin comment (english version)
        $originComment = $this->commentServices->getCurrentComment($request->all());

        if (!(empty($request->all()) || ($request->has(['lang', 'comment_id']) && $originComment))) {
            abort(404);
        }

        $lang = $request->lang ? $request->lang : 'en';

        return view('backend.comment.create', [
            'originComment' => $originComment,
            'lang' => $lang
        ]);
    }

    /**
     * @param CommentStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CommentStore $request)
    {
        $response = $this->commentServices->createComment($request);

        return redirect()->route('comment.index')->with([
            'success' => $response
        ]);
    }

    public function edit(Request $request, $id)
    {
        $comment = $this->commentServices->getInformationCommentById($id);

        if (empty($comment)) {
            abort(404);
        }

        return view('backend.comment.update', [
            'comment' => $comment,
            'lang' => $comment->lang
        ]);
    }

    /**
     * Update comment.
     * @param CommentStore $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(CommentStore $request, $id)
    {
        $response = $this->commentServices->updateComment($request, $id);

        return redirect()->route('comment.index')->with([
            'success' => $response
        ]);
    }

    public function destroy($id)
    {
        $response = $this->commentServices->deleteComment($id);

        return redirect()->route('comment.index')->with([
            'success' => $response
        ]);
    }
}
