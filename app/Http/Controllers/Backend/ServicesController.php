<?php

namespace App\Http\Controllers\Backend;

use App\Services\FeatureServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    private $featureServices;

    public function __construct(FeatureServices $featureServices)
    {
        parent::__construct();

        $this->featureServices = $featureServices;
    }

    public function create(Request $request)
    {
        // get origin comment (english version)
        $originComment = $this->featureServices->getCurrentComment($request->all());

        if (!(empty($request->all()) || ($request->has(['lang', 'comment_id']) && $originComment))) {
            abort(404);
        }

        $lang = $request->lang ? $request->lang : 'en';

        return view('backend.comment.create', [
            'originComment' => $originComment,
            'lang' => $lang
        ]);
    }
}
