<?php

namespace App\Http\Controllers\Frontend;

use App\Services\ArticleServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    private $articleServices;

    public function __construct(ArticleServices $articleServices)
    {
        parent::__construct();

        $this->articleServices = $articleServices;
    }

    public function index(Request $request)
    {
        $lang = $request->lang ? $request->lang : config('const.lang.en.alias');

        if (\App::getLocale() !== $lang) {
            \App::setLocale($lang);
        }

        $searchInformation = $this->articleServices->getSearchInformation($request->all());

        if (!$searchInformation['valid']) {
            return redirect('/');
        }

        $istays = $this->articleServices->getAllIstayByLang($lang, $this->landingType);

        $rooms = $this->articleServices->getRooms($searchInformation['params']);

        return view('article.index', [
            'istays' => $istays,
            'rooms' => $rooms,
            'params' => $searchInformation['params'],
            'istaysSimple' => array_pluck($istays, 'name', 'id')
        ]);
    }

    public function details(Request $request, $room)
    {
        $lang = $request->lang ? $request->lang : config('const.lang.en.alias');

        if (\App::getLocale() !== $lang) {
            \App::setLocale($lang);
        }

        $room = $this->articleServices->getInformationRoom($room, $lang);

        $istay = $this->articleServices->getInformationIstayById($room['parent_id'], $lang);

        $services = $this->articleServices->getServicesByIstay($room['parent_id'], $lang);

        $similarRooms = $this->articleServices->getSimilarRooms($room['parent_id'], $room['id'], $lang);

        if (!$room) {
            return redirect('/');
        }

        return view('article.details', [
            'room' => $room,
            'istay' => $istay,
            'services' => $services,
            'similarRooms' => $similarRooms
        ]);
    }

    public function istay(Request $request, $slug)
    {

    }
}
