<?php

namespace App\Services;


use App\Models\Comment;
use App\Services\Common\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentServices
{
    private $imageServices;

    public function __construct(ImageServices $imageServices)
    {
        $this->imageServices = $imageServices;
    }

    public function getCurrentComment($dataRequest)
    {
        if (empty($dataRequest) || empty($dataRequest['comment_id'])) {
            return null;
        }

        $comment = Comment::findOriginCommentById($dataRequest['comment_id']);

        if (!$comment) {
            return null;
        }

        return $comment;
    }

    public function getIndexComment()
    {
        $comments = Comment::getAllComments();

        $comments = $this->resolveComments($comments);

        return $comments;
    }

    private function resolveComments($comments)
    {
        $result = [];

        foreach ($comments as $item) {
            if (array_key_exists($item['id'], $result)) {
                $result[$item['id']]['id_content_' . $item['lang']] = $item['id_content'];

                $result[$item['id']]['name_' . $item['lang']] = $item['name'];

                $result[$item['id']]['content_' . $item['lang']] = $item['content'];
            } else {
                $result[$item['id']] = [
                    'id' => $item['id'],
                    'id_content_' . $item['lang'] => $item['id_content'],
                    'name_' . $item['lang'] => $item['name'],
                    'content_' . $item['lang'] => $item['content'],
                    'created_at' => $item['created_at'],
                ];
            }
        }

        return $result;
    }

    /**
     * Create comment.
     * @param $request
     * @return string
     * @throws \Exception
     */
    public function createComment($request)
    {
        try {
            DB::beginTransaction();

            $respon = $this->storeComment($request);

            DB::commit();

            return $respon;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Store comment.
     * @param Request $request
     * @return string
     */
    public function storeComment($request)
    {
        $data = $request->all();

        $data['user_id'] = \Auth::user()->id;

        if (empty($data['comment_id'])) {
            // create comment.
            $comment = Comment::create($data);
        } else {
            $comment = Comment::find($data['comment_id']);
        }

        if ($request->hasFile('avatar')) {
            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('avatar'), 'comment');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['avatar'] = $fileName;
        }

        $comment->commentContent()->create($data);

        return 'Create comment by "' . $request->name . '" successful';
    }

    public function getInformationCommentById($commentContentId)
    {
        $comment = Comment::findCommentByCommentContentId($commentContentId);

        return $comment;
    }
}