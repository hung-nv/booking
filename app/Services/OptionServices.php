<?php

namespace App\Services;

use App\Http\Requests\SettingRequest;
use App\Models\Post;
use App\Models\MenuGroup;
use App\Models\Option;
use App\Services\Common\ImageServices;
use Illuminate\Support\Facades\DB;

class OptionServices extends BaseServices
{
    private $imageServices;

    public function __construct(ImageServices $imageServices)
    {
        parent::__construct();

        $this->imageServices = $imageServices;
    }

    /**
     * Get all option to setup site.
     * @param $landingType
     * @return array
     */
    public function getDataSetting($landingType)
    {
        $options = Option::select(['key', 'value'])->pluck('value', 'key');

        $pages = Post::getAllPages([$landingType]);

        $menus = MenuGroup::all();

        return ['options' => $options, 'pages' => $pages, 'menus' => $menus];
    }

    /**
     * Save setting.
     * @param SettingRequest $request
     * @throws \Exception
     */
    public function saveSetting($request)
    {
        try {
            DB::beginTransaction();

            $this->saveOptionPackages($request);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Save all option setting.
     * @param SettingRequest $request
     * @throws \Exception
     */
    private function saveOptionPackages($request)
    {
        $dataRequest = $request->all();

        unset($dataRequest['_token']);

        foreach ($dataRequest as $k => $v) {
            $option = Option::where('key', $k)->get()->first();

            if (!$v) {
                if ($option) {
                    $option->delete();
                }

                continue;
            }
            // except other value.
            if (strlen(strstr($k, 'old')) > 0 || strlen(strstr($k, '_method')) > 0) {
                continue;
            }

            if ($request->hasFile($k)) {
                // upload image if exist.
                $value = $this->imageServices->uploads($request->file($k), 'setting');
            } else {
                $value = $v;

                if (is_array($v)) {
                    $value = implode(',', $v);
                }
            }

            if ($option) {
                if (strlen(strstr($option->value, 'uploads/setting'))) {
                    $this->imageServices->deleteImage($option->value);
                }

                $option->value = $value;

                $option->save();
            } else {
                Option::create(['key' => $k, 'value' => $value]);
            }
        }
    }

    /**
     * Delete file setting.
     * @param $dataRequest
     */
    public function deleteFileSetting($dataRequest)
    {
        $option = Option::where('key', $dataRequest['name'])->get()->first();

        if ($option) {
            $this->imageServices->deleteImage($option->value);

            $option->value = '';

            $option->save();
        }
    }
}