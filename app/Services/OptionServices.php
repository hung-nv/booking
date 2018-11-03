<?php

namespace App\Services;

use App\Http\Requests\SettingRequest;
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
     * @return array
     */
    public function getDataSetting($lang)
    {
        $options = Option::select(['key', 'value'])->where('lang', $lang)->pluck('value', 'key');

        return ['options' => $options];
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

        $lang = $request->lang;

        unset($dataRequest['_token']);
        unset($dataRequest['lang']);

        foreach ($dataRequest as $k => $v) {
            $option = Option::findOptionByKeyAndLang($k, $lang);

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
            }

            if ($option) {
                if (strlen(strstr($option->value, 'uploads/setting'))) {
                    $this->imageServices->deleteImage($option->value);
                }

                $option->value = $value;

                $option->save();
            } else {
                Option::create(['key' => $k, 'value' => $value, 'lang' => $lang]);
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