<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CategoryContent;
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
     * @param Request $request
     * @return string
     * @throws \Throwable
     */
    public function getIndexCategory($request)
    {
        $category = Category::getAllCategory();

        $category = $this->resolveCollectionCategory($category);

        $templateCategory = $this->getTemplateIndexCategory($category);

        return $templateCategory;
    }

    /**
     * Resolve all language of category to one record.
     * @param $category
     * @return array
     */
    public function resolveCollectionCategory($category)
    {
        $result = [];

        foreach ($category as $item) {
            if (array_key_exists($item['id'], $result)) {
                $result[$item['id']]['id_content_' . $item['lang']] = $item['id_content'];

                $result[$item['id']]['name_' . $item['lang']] = $item['name'];
            } else {
                $result[$item['id']] = [
                    'id' => $item['id'],
                    'id_content_' . $item['lang'] => $item['id_content'],
                    'name_' . $item['lang'] => $item['name'],
                    'parent_id' => $item['parent_id'],
                    'status' => $item['status'],
                    'slug' => $item['slug']
                ];
            }
        }

        return $result;
    }

    /**
     * Get current category. (origin category to translate)
     * @param $dataRequest
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getCurrentCategory($dataRequest)
    {
        if (empty($dataRequest) || empty($dataRequest['category_id'])) {
            return null;
        }

        $category = Category::findOriginCategoryById($dataRequest['category_id']);

        if (!$category) {
            return null;
        }

        return $category;
    }

    /**
     * Get template select option for category.
     * @param $selectedId
     * @return string
     */
    public function getSelectCategory($selectedId)
    {
        $dataCategory = Category::getCategoryByLang(config('const.lang.en.alias'));

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
                if ($item['parent_id'] == $parentId) {
                    $template[] = view('backend.category.partial._itemCategory', [
                        'item' => $item,
                        'character' => $character
                    ])->render();

                    unset($category[$key]);

                    $this->getTemplateIndexCategory($category, $item['id'], $character . '|---', $template);
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
        try {
            DB::beginTransaction();

            $respon = $this->storeCategory($request);

            DB::commit();

            return $respon;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Store category.
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function storeCategory($request)
    {
        $data = $request->all();

        // set system_link_type is 'category'
        $data['system_link_type_id'] = 1;

        // set parent_id
        $data['parent_id'] = empty($data['parent_id']) ? null : $data['parent_id'];

        if (empty($data['category_id'])) {
            // create category.
            $category = Category::create($data);
        } else {
            $category = Category::find($data['category_id']);
        }

        if ($request->hasFile('image')) {
            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('image'), 'category');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['image'] = $fileName;
        }

        // store category content.
        $category->categoryContent()->create($data);

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
     * @param Request $request
     * @param $categoryId
     * @return string
     * @throws \Exception
     */
    public function updateCategoryById($request, $categoryId)
    {
        // get category content.
        $categoryContent = CategoryContent::find($categoryId);

        // get category.
        $category = $categoryContent->category;

        // update category if edit version english.
        if ($request->has(['slug'])) {
            $category->update([
                'parent_id' => $request->parent_id,
                'slug' => $request->slug
            ]);
        }

        $oldSlug = $category->slug;
        $oldType = $category->system_link_type_id;

        $data = $request->all();

        if ($request->hasFile('image')) {
            // delete old image category.
            $this->imageServices->deleteImage($categoryContent->image);

            // upload image to folder.
            $fileName = $this->imageServices->uploads($request->file('image'), 'category');

            if (empty($fileName)) {
                return 'Fail';
            }

            $data['image'] = $fileName;
        }

        $categoryContent->update($data);

        //update menu.
        $this->menuServices->upadteCategoryToMenu($category, $oldSlug, $oldType);

        $message = 'Update category "' . $categoryContent->name . '" successful';

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

//        $this->menuServices->deleteCategoryFromMenu($category->slug, $category->system_link_type_id);

        return 'Delete category "' . $category->name . '" successful';
    }

    /**
     * Get Information Category
     * @param $categoryId
     * @return array|null
     */
    public function getInformationCategoryById($categoryId)
    {
        $category = Category::findCategoryById($categoryId);

        if (empty($category)) {
            return null;
        }

        $dataCategory = Category::getCategoryByLang(config('const.lang.en.alias'), [$categoryId]);

        $template = $this->getTemplateSelectCategory($dataCategory, $category->parent_id);

        return ['category' => $category, 'templateSelectCategory' => $template];
    }

    /**
     * Delete category image by category id.
     * @param $categoryContentId
     * @return array
     */
    public function deleteImageByCategoryId($categoryContentId)
    {
        $category = CategoryContent::findOrFail($categoryContentId);

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