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

    public function getCurrentComment($dataRequest)
    {
        if (empty($dataRequest) || empty($dataRequest['comment_id'])) {
            return null;
        }

        $services = Services::findOriginCommentById($dataRequest['comment_id']);

        if (!$services) {
            return null;
        }

        return $services;
    }

    public function getIndexComment()
    {
        $services = Services::getAllComments();

        $services = $this->resolveComments($services);

        return $services;
    }

    private function resolveComments($services)
    {
        $result = [];

        foreach ($services as $item) {
            if (array_key_exists($item['id'], $result)) {
                $result[$item['id']]['id_content_' . $item['lang']] = $item['id_content'];

                $result[$item['id']]['name_' . $item['lang']] = $item['name'];

                $result[$item['id']]['content_' . $item['lang']] = $item['content'];
            } else {
                $result[$item['id']] = [
                    'id' => $item['id'],
                    'id_content_' . $item['lang'] => $item['id_content'],
                    'name_' . $item['lang'] => $item['name'],
                    'content_' . $item['lang'] => $item['content'],
                    'created_at' => $item['created_at'],
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

        if (empty($data['comment_id'])) {
            // create comment.
            $services = Services::create($data);
        } else {
            $services = Services::find($data['comment_id']);
        }

        if ($request->hasFile('avatar')) {
            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('avatar'), 'comment');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['avatar'] = $fileName;
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
    public function updateComment($request, $id)
    {
        try {
            DB::beginTransaction();

            $response = $this->updateCommentById($request, $id);

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
    public function updateCommentById($request, $servicesId)
    {
        // get category content.
        $ServicesContent = ServicesContent::find($servicesId);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            // delete old image category.
            $this->imageServices->deleteImage($ServicesContent->image);

            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('avatar'), 'comment');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['avatar'] = $fileName;
        }

        $ServicesContent->update($data);

        $message = 'Update category "' . $ServicesContent->name . '" successful';

        return $message;
    }

    public function getInformationCommentById($ServicesContentId)
    {
        $services = Services::findCommentByServicesContentId($ServicesContentId);

        return $services;
    }

    /**
     * Delete comment.
     * @param $servicesId
     * @throws \Exception
     */
    public function deleteComment($servicesId)
    {
        try {
            DB::beginTransaction();

            $response = $this->deleteCommentById($servicesId);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Delete comment.
     * @param $servicesId
     * @throws \Exception
     */
    public function deleteCommentById($servicesId)
    {
        $services = Services::find($servicesId);

        $services->delete();
    }

    public function deleteAvatarByServicesContentId($servicesContentId)
    {
        $ServicesContent = ServicesContent::findOrFail($servicesContentId);

        if (!$ServicesContent) {
            throw new NotFoundHttpException('Not found post');
        } else {
            $deleteFile = $this->imageServices->deleteImage($ServicesContent->avatar);

            if (empty($deleteFile)) {
                throw new NotFoundHttpException('Not found image');
            }

            $ServicesContent->update(['avatar' => null]);

            return ['message' => 'Delete file successful'];
        }
    }
}