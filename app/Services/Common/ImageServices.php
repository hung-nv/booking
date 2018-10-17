<?php

namespace App\Services\Common;

use Illuminate\Support\Facades\File as File;

class ImageServices
{
    /**
     * Copy image.
     * @param $srcImage
     * @return bool|string
     */
    public function copyImage($srcImage)
    {
        if ($srcImage && File::exists(public_path($srcImage))) {
            // get folder to upload
            $folderUpload = $this->getFolderUpload($srcImage);

            // set folder to save
            $folderPath = $this->setFolderUpload($folderUpload);

            // get and create container folder if needed
            if (!is_dir(public_path($folderPath))) {
                File::makeDirectory(public_path($folderPath), intval(0755, 8), true);
            }

            $fileName = date('YmdHis', time()) . '-' . $this->getImageNameByPath($srcImage);

            if (File::copy(public_path($srcImage), public_path($folderPath) . $fileName)) {
                return $folderPath . $fileName;
            } else {
                return false;
            }
        }

        return false;
    }

    /**
     * Upload images.
     * @param $file
     * @param $folderUpload
     * @param string $name
     * @return null|string
     * @throws \Exception
     */
    public function uploads($file, $folderUpload, $name = '')
    {
        try {
            //name of uploaded file
            $pathinfo = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            //extension
            $extension = $file->getClientOriginalExtension();

            //set folder to save
            $folderPath = $this->setFolderUpload($folderUpload);

            //get and create container folder if needed
            if (!is_dir(public_path($folderPath))) {
                File::makeDirectory(public_path($folderPath), intval(0755, 8), true);
            }

            if (isset($name) && $name) {
                $fileName = $name;
            } else {
                $fileName = date('YmdHis', time()) . '-' . str_slug($pathinfo) . '.' . $extension;
            }

            //save image to path
            if ($file->move(public_path($folderPath), $fileName)) {
                return $folderPath . $fileName;
            }

            return null;

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Set folder to upload image.
     * @param string $folderUpload
     * @param int $level : 1 -> Y, 2->Ym, 3 -> Ymd, default -> Ymd
     * @return string
     */
    public function setFolderUpload($folderUpload, $level = 2)
    {

        //remove special char
        $folder = str_replace(' ', '-', $folderUpload); // Replaces all spaces with hyphens.
        $imagePath = '/uploads/' . strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $folder)) . '/';

        switch ($level) {
            case 1:
                $folderPath = $imagePath . date('Y', time()) . '/';
                break;
            case 2:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/';
                break;
            case 3:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/' . date('d', time()) . '/';
                break;
            default:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/' . date('d', time()) . '/';
        }

        return $folderPath;
    }

    /**
     * Delete image.
     * @param $srcImage
     * @return bool
     */
    public function deleteImage($srcImage)
    {
        if ($srcImage && file_exists(public_path($srcImage))) {
            File::delete(public_path($srcImage));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get folder name.
     * @param $srcImage
     * @return mixed
     */
    private function getFolderUpload($srcImage)
    {
        $srcImage = explode('/', $srcImage);

        return $srcImage[2];
    }

    /**
     * Get image name by path.
     * @param $srcImage
     * @return array|string
     */
    private function getImageNameByPath($srcImage)
    {
        // split image path.
        $srcImage = explode('/', $srcImage);

        // get last element.
        $originImage = array_last($srcImage);

        $image = explode('-', $originImage);

        // remove first element (datetime)
        array_shift($image);

        $image = implode('-', $image);

        return $image;
    }
}