<?php

namespace App\Http\Controllers\Api;

use App\Services\CategoryServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiCategoryController extends Controller
{
    private $categoryServices;

    public function __construct(CategoryServices $categoryServices)
    {
        parent::__construct();
        $this->categoryServices = $categoryServices;
    }

    /**
     * Delete category image by category id.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(Request $request)
    {
        try {
            $response = $this->categoryServices->deleteImageByCategoryId($request->key);

            return response()->json($response);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
