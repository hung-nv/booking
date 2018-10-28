<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ArticleGroupSave;
use App\Services\ArticleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiPostController extends Controller
{
    private $postServices;

    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();
        $this->postServices = $articleServices;
    }

    /**
     * Delete post image.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(Request $request)
    {
        try {
            $response = $this->postServices->deleteImageByPostId($request->key);

            return response()->json($response);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    /**
     * Add post to group.
     * @param ArticleGroupSave $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addGroup(ArticleGroupSave $request)
    {
        try {
            $response = $this->postServices->addPostToGroup($request->all());

            return response()->json(['message' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Remove post from group.
     * @param ArticleGroupSave $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeGroup(ArticleGroupSave $request)
    {
        try {
            $response = $this->postServices->removePostToGroup($request->all());

            return response()->json(['message' => $response], 200);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Delete image of landing page.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImageLanding(Request $request)
    {
        try {
            $response = $this->postServices->deleteImageLandingByPageId($request->key, $request->name);

            return response()->json($response);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
