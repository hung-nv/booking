<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ContactStore;
use App\Services\ContactServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    private $contactServices;

    public function __construct(ContactServices $contactServices)
    {
        parent::__construct();

        $this->contactServices = $contactServices;
    }

    public function book(Request $request)
    {
        try {
            $respon = $this->contactServices->createContact($request->all());

            return response()->json($respon);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
