<?php

namespace App\Services;

use App\Models\Services;
use App\Models\ServicesContent;
use App\Services\Common\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FeatureServices
{
    private $imageServices;

    public function __construct(ImageServices $imageServices)
    {
        $this->imageServices = $imageServices;
    }

    public function getCurrentServices($dataRequest)
    {
        if (empty($dataRequest) || empty($dataRequest['services_id'])) {
            return null;
        }

        $services = Services::findOriginServicesById($dataRequest['services_id']);

        if (!$services) {
            return null;
        }

        return $services;
    }

    public function getIndexServices()
    {
        $services = Services::getAllServices();

        $services = $this->resolveServices($services);

        return $services;
    }

    private function resolveServices($services)
    {
        $result = [];

        foreach ($services as $item) {
            if (array_key_exists($item['id'], $result)) {
                $result[$item['id']]['id_content_' . $item['lang']] = $item['id_content'];

                $result[$item['id']]['name_' . $item['lang']] = $item['name'];
            } else {
                $result[$item['id']] = [
                    'id' => $item['id'],
                    'id_content_' . $item['lang'] => $item['id_content'],
                    'name_' . $item['lang'] => $item['name'],
                    'created_at' => $item['created_at'],
                    'icon' => $item['icon'],
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
    public function createServices($request)
    {
        try {
            DB::beginTransaction();

            $respon = $this->storeServices($request);

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
     * @throws \Exception
     */
    public function storeServices($request)
    {
        $data = $request->all();

        $data['user_id'] = \Auth::user()->id;

        if (empty($data['services_id'])) {
            // create comment.
            $services = Services::create($data);
        } else {
            $services = Services::find($data['services_id']);
        }

        $services->servicesContent()->create($data);

        return 'Create comment by "' . $request->name . '" successful';
    }

    /**
     * Update comment.
     * @param $request
     * @param $id
     * @return string
     * @throws \Exception
     */
    public function updateServices($request, $id)
    {
        try {
            DB::beginTransaction();

            $response = $this->updateServicesById($request, $id);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Update comment content.
     * @param Request $request
     * @param $servicesId
     * @return string
     * @throws \Exception
     */
    public function updateServicesById($request, $servicesId)
    {
        // get category content.
        $servicesContent = ServicesContent::find($servicesId);

        $data = $request->all();

        $servicesContent->update($data);

        if ($request->has('icon')) {
            $servicesContent->services()->update([
                'icon' => $data['icon']
            ]);
        }

        $message = 'Update category "' . $servicesContent->name . '" successful';

        return $message;
    }

    public function getInformationServicesById($servicesContentId)
    {
        $services = Services::findServicesByServicesContentId($servicesContentId);

        return $services;
    }

    /**
     * Delete services.
     * @param $servicesId
     * @return string
     * @throws \Exception
     */
    public function deleteServices($servicesId)
    {
        try {
            DB::beginTransaction();

            $response = $this->deleteServicesById($servicesId);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Delete services.
     * @param $servicesId
     * @return string
     * @throws \Exception
     */
    public function deleteServicesById($servicesId)
    {
        $services = Services::find($servicesId);

        $services->delete();

        return 'Delete successful';
    }
}