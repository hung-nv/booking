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
            return redirect('/?lang=' . $lang);
        }

        $istays = $this->articleServices->getAllIstayByLang($lang, $this->landingType);

        $rooms = $this->articleServices->getRooms($searchInformation['params']);

        return view('article.index', [
            'lang' => $lang,
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

        if (!$room) {
            return redirect('/?lang=' . $lang);
        }

        $istay = $this->articleServices->getInformationIstayById($room['parent_id'], $lang);

        if (!empty($istay['google-map'])) {
            $istay['google-map'] = preg_replace('/width\=\"(.*?)\"/', 'width="100%"', $istay['google-map']);
            $istay['google-map'] = preg_replace('/height\=\"(.*?)\"/', 'height="100%"', $istay['google-map']);
        }

        $services = $this->articleServices->getServicesByIstay($room['parent_id'], $lang);

        $similarRooms = $this->articleServices->getSimilarRooms($room['parent_id'], $lang, [$room['id']]);

        return view('article.details', [
            'lang' => $lang,
            'room' => $room,
            'istay' => $istay,
            'services' => $services,
            'similarRooms' => $similarRooms
        ]);
    }

    public function istay(Request $request, $slug)
    {
        $lang = $request->lang ? $request->lang : config('const.lang.en.alias');

        if (\App::getLocale() !== $lang) {
            \App::setLocale($lang);
        }

        $istay = $this->articleServices->getInformationIstay($slug, $lang);

        if (!$istay) {
            return redirect('/?lang=' . $lang);
        }

        if (!empty($istay['google-map'])) {
            $istay['google-map'] = preg_replace('/width\=\"(.*?)\"/', 'width="100%"', $istay['google-map']);
            $istay['google-map'] = preg_replace('/height\=\"(.*?)\"/', 'height="100%"', $istay['google-map']);
        }

        $services = $this->articleServices->getServicesByIstay($istay['article_id'], $lang);

        $roomsAvailable = $this->articleServices->getRoomsWithOptions($istay['article_id'], $lang);

        $similarRooms = $this->articleServices->getOtherRooms(array_pluck($roomsAvailable, 'id'), $lang);

        return view('article.istay', [
            'lang' => $lang,
            'roomsAvailable' => $roomsAvailable,
            'similarRooms' => $similarRooms,
            'istay' => $istay,
            'services' => $services
        ]);
    }
}
