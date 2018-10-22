<?php

namespace App\Services;

use App\Models\Category;
use App\Services\Common\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryServices
{
    private $imageServices;

    private $menuServices;

    public function __construct(ImageServices $imageServices, MenuServices $menuServices)
    {
        $this->imageServices = $imageServices;

        $this->menuServices = $menuServices;
    }

    /**
     * Get all category.
     * @return string
     * @throws \Throwable
     */
    public function getIndexCategory()
    {
        $category = Category::all();

        $templateCategory = $this->getTemplateIndexCategory($category);

        return $templateCategory;
    }

    /**
     * Get template select option for category.
     * @param $selectedId
     * @return string
     */
    public function getSelectCategory($selectedId)
    {
        $dataCategory = Category::all();

        return $this->getTemplateSelectCategory($dataCategory, $selectedId);
    }

    /**
     * Get template select option for category.
     * @param $dataCategory
     * @param null $selectedId
     * @param null $parentId
     * @param string $character
     * @param array $template
     * @return string
     */
    public function getTemplateSelectCategory($dataCategory, $selectedId = null, $parentId = null, $character = '', &$template = [])
    {
        if (count($dataCategory) > 0) {
            foreach ($dataCategory as $key => $item) {
                if ($item->parent_id == $parentId) {
                    if ($item->id === $selectedId) {
                        $template[] = '<option value="' . $item->id . '" selected>'
                            . $character . $item->name
                            . '</option>';
                    } else {
                        $template[] = '<option value="' . $item->id . '">' . $character . $item->name . '</option>';
                    }

                    unset($dataCategory[$key]);

                    $this->getTemplateSelectCategory($dataCategory, $selectedId, $item->id, $character . '|---', $template);
                }
            }
        }

        return implode('', $template);
    }

    /**
     * Get template index category.
     * @param $category
     * @param null $parentId
     * @param string $character
     * @param array $template
     * @return string
     * @throws \Throwable
     */
    public function getTemplateIndexCategory($category, $parentId = null, $character = '', &$template = [])
    {
        if (count($category) > 0) {
            foreach ($category as $key => $item) {
                if ($item->parent_id == $parentId) {
                    $template[] = view('backend.category.partial._itemCategory', [
                        'item' => $item,
                        'character' => $character
                    ])->render();

                    unset($category[$key]);

                    $this->getTemplateIndexCategory($category, $item->id, $character . '|---', $template);
                }
            }
        }

        return implode('', $template);
    }

    /**
     * Create category.
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function createCategory($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('image'), 'category');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['image'] = $fileName;
        }

        // set system_link_type is 'category'
        $data['system_link_type_id'] = 1;

        $data['parent_id'] = empty($data['parent_id']) ? null : $data['parent_id'];

        $category = Category::create($data);

        $message = 'Create category "' . $category->name . '" successful';

        return $message;
    }

    /**
     * Update category transaction.
     * @param $request
     * @param $categoryId
     * @return string
     * @throws \Exception
     */
    public function updateCategory($request, $categoryId)
    {
        try {
            DB::beginTransaction();

            $response = $this->updateCategoryById($request, $categoryId);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Update category.
     * @param $request
     * @param $categoryId
     * @return string
     * @throws \Exception
     */
    public function updateCategoryById($request, $categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $oldSlug = $category->slug;
        $oldType = $category->system_link_type_id;

        $data = $request->all();

        if ($request->hasFile('image')) {
            // delete old image category.
            $this->imageServices->deleteImage($category->image);

            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('image'), 'category');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['image'] = $fileName;
        }

        $data['parent_id'] = empty($data['parent_id']) ? null : $data['parent_id'];

        $category->update($data);

        //update menu.
        $this->menuServices->upadteCategoryToMenu($category, $oldSlug, $oldType);

        $message = 'Update category "' . $category->name . '" successful';

        return $message;
    }

    /**
     * Delete category.
     * @param $categoryId
     * @return string
     * @throws \Exception
     */
    public function deleteCategory($categoryId)
    {
        try {
            DB::beginTransaction();

            $response = $this->deleteCategoryById($categoryId);

            DB::commit();

            return $response;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Delete category by id.
     * @param $categoryId
     * @return string
     * @throws \Exception
     */
    public function deleteCategoryById($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $category->delete();

        $this->imageServices->deleteImage($category->image);

        $this->menuServices->deleteCategoryFromMenu($category->slug, $category->system_link_type_id);

        return 'Delete category "' . $category->name . '" successful';
    }

    /**
     * Get Information Category
     * @param $categoryId
     * @return array
     * @throws \Exception
     */
    public function getInformationCategoryById($categoryId)
    {
        try {
            $category = Category::findOrFail($categoryId);

            $dataCategory = Category::all();

            $template = $this->getTemplateSelectCategory($dataCategory, $category->parent_id);

            return ['category' => $category, 'templateSelectCategory' => $template];
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Delete category image by category id.
     * @param $categoryId
     * @return array
     */
    public function deleteImageByCategoryId($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        if (!$category) {
            throw new NotFoundHttpException('Not found category.');
        } else {
            $deleteFile = $this->imageServices->deleteImage($category->image);

            if (empty($deleteFile)) {
                throw new NotFoundHttpException('Not found image.');
            }

            $category->update(['image' => null]);

            return ['message' => 'Delete file successful.'];
        }
    }
}