<?php

namespace App\Http\Controllers\Api;

use App\Services\OptionServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiOptionController extends Controller
{
    private $optionServices;

    public function __construct(OptionServices $optionServices)
    {
        parent::__construct();

        $this->optionServices = $optionServices;
    }

    /**
     * Delete file setting.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile(Request $request)
    {
        try {
            $this->optionServices->deleteFileSetting($request->all());

            return response()->json('Delete file successful');
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
