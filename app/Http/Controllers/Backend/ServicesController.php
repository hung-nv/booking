<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ServicesStore;
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

    /**
     * Create services.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        // get origin comment (english version)
        $originServices = $this->featureServices->getCurrentServices($request->all());

        if (!(empty($request->all()) || ($request->has(['lang', 'services_id']) && $originServices))) {
            abort(404);
        }

        $lang = $request->lang ? $request->lang : 'en';

        return view('backend.services.create', [
            'originServices' => $originServices,
            'lang' => $lang
        ]);
    }

    /**
     * Store Services.
     * @param ServicesStore $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(ServicesStore $request)
    {
        $response = $this->featureServices->createServices($request);

        return redirect()->route('services.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Index services.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $services = $this->featureServices->getIndexServices();

        $lang = $request->lang ? $request->lang : 'en';

        return view('backend.services.index', [
            'services' => $services,
            'lang' => $lang
        ]);
    }

    public function edit($id)
    {
        $services = $this->featureServices->getInformationServicesById($id);

        if (empty($services)) {
            abort(404);
        }

        return view('backend.services.update', [
            'services' => $services,
            'lang' => $services->lang
        ]);
    }

    /**
     * Update services.
     * @param ServicesStore $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(ServicesStore $request, $id)
    {
        $response = $this->featureServices->updateServices($request, $id);

        return redirect()->route('services.index')->with([
            'success' => $response
        ]);
    }

    /**
     * Delete services.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $response = $this->featureServices->deleteServices($id);

        return redirect()->route('services.index')->with([
            'success' => $response
        ]);
    }
}
