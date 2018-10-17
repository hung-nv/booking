<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AttributeRequest;
use App\Http\Controllers\Controller;
use App\Services\AttributeServices;

class ApiAttributeController extends Controller
{
    private $attributeServices;

    public function __construct(AttributeServices $attributeServices)
    {
        parent::__construct();
        $this->attributeServices = $attributeServices;
    }

    /**
     * Add attribute.
     * @param AttributeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAttribute(AttributeRequest $request)
    {
        try {
            $response = $this->attributeServices->addAttributre($request->all());

            return response()->json(['message' => $response]);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Get attribute.
     * @param $attributeType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAttribute($attributeType)
    {
        $attribute = $this->attributeServices->getAttributeByType($attributeType);
        return view('backend.api.attribute', [
            'attribute' => $attribute
        ]);
    }
}
