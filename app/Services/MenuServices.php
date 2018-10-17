<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Menu;
use App\Models\SystemLinkType;
use App\Models\Post;
use App\Models\MenuGroup;
use App\Utilities\MultiLevel;
use Illuminate\Support\Facades\DB;

class MenuServices extends Services
{
    use MultiLevel;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Update sort menu.
     * @param $dataRequest
     */
    public function updateSort($dataRequest)
    {
        if (count($dataRequest['data']) > 0) {
            $this->updateSortMenu($dataRequest['data'], 0);
        }
    }

    /**
     * Update sort menu.
     * @param $dataRequest
     * @param $order
     * @param null $parent
     */
    private function updateSortMenu($dataRequest, $order, $parent = null)
    {
        foreach ($dataRequest as $item) {
            $menu = Menu::find($item['id']);
            $menu->update(['sort' => $order, 'parent_id' => $parent]);

            $order++;

            if (isset($item['children']) && $item['children']) {
                $parent_id = $item['id'];
                $this->updateSortMenu($item['children'], $order, $parent_id);
            }
        }
    }

    /**
     * Get all menu groups.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllMenuGroups()
    {
        return MenuGroup::all();
    }

    /**
     * Get template menu nestable to reload.
     * @param int $idGroup
     * @return string
     */
    public function getTemplateMenu($idGroup)
    {
        $dataMenus = $this->getMenuByGroup($idGroup);

        $templateMenu = $this->getTemplateMenuNestable($dataMenus);

        return $templateMenu;
    }

    /**
     * Get menu by group.
     * @param $idGroup
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMenuByGroup($idGroup)
    {
        return Menu::getMenuByGroup($idGroup);
    }

    /**
     * Add category to menu.
     * @param $dataRequest
     * @throws \Exception
     */
    public function addCategoryToMenu($dataRequest)
    {
        try {
            DB::beginTransaction();

            foreach ($dataRequest['ids'] as $id) {
                $category = Category::find($id);

                $data = [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'menu_group_id' => $dataRequest['idMenuGroup'],
                    'system_link_type_id' => $category->system_link_type_id,
                    'prefix' => $this->configLink[$category->system_link_type_id]
                ];

                Menu::create($data);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Add page to menu.
     * @param $dataRequest
     * @throws \Exception
     */
    public function addPageToMenu($dataRequest)
    {
        try {
            DB::beginTransaction();

            foreach ($dataRequest['ids'] as $id) {
                $page = Post::findOrFail($id);

                Menu::create([
                    'name' => $page->name,
                    'slug' => $page->slug,
                    'menu_group_id' => $dataRequest['idMenuGroup'],
                    'system_link_type_id' => $page->system_link_type_id,
                    'prefix' => $this->configLink[$page->system_link_type_id]
                ]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Add custom to menu.
     * @param $dataRequest
     */
    public function addCustomToMenu($dataRequest)
    {
        Menu::create([
            'name' => $dataRequest['name'],
            'slug' => str_slug($dataRequest['name']),
            'direct' => $dataRequest['url'],
            'menu_group_id' => $dataRequest['idMenuGroup']
        ]);
    }

    /**
     * Get checkbox all category.
     * @param $parent
     * @return string
     * @throws \Throwable
     */
    public function getCheckboxAllCategory($parent)
    {
        $category = Category::all();

        $template = $this->getTemplateCheckboxCategory($category, $parent);

        return $template;
    }

    /**
     * Create menu group.
     * @param $data
     * @return MenuGroup|\Illuminate\Database\Eloquent\Model
     */
    public function createMenuGroup($data)
    {
        return MenuGroup::create(['name' => $data['name']]);
    }

    /**
     * Get data menu.
     * @param $pageType
     * @param $idMenuGroup
     * @return array
     */
    public function getDataMenu($pageType, $idMenuGroup)
    {
        $pages = Post::getAllPages([$pageType]);

        if (empty($idMenuGroup)) {
            $templateMenu = '';
        } else {
            $templateMenu = $this->getTemplateMenu($idMenuGroup);
        }

        $menuGroups = MenuGroup::all();

        return ['pages' => $pages, 'templateMenu' => $templateMenu, 'menuGroups' => $menuGroups];
    }

    /**
     * UPdate category to menu.
     * @param $category
     * @param $oldSlug
     * @param $oldType
     */
    public function upadteCategoryToMenu($category, $oldSlug, $oldType)
    {
        $systemLinkType = SystemLinkType::find($category->system_link_type_id);

        if ($systemLinkType) {
            $data = [
                'slug' => $category->slug,
                'name' => $category->name,
                'prefix' => $systemLinkType->prefix,
                'system_link_type_id' => $systemLinkType->id
            ];

            Menu::where([
                ['slug', $oldSlug],
                ['system_link_type_id', $oldType]
            ])->update($data);
        }
    }

    /**
     * Update page to menu.
     * @param $oldSlug
     * @param $new_name
     * @param $new_slug
     */
    public function updatePageToMenu($oldSlug, $new_name, $new_slug)
    {
        Menu::where([
            ['slug', $oldSlug]
        ])->update([
            'name' => $new_name,
            'slug' => $new_slug
        ]);
    }

    /**
     * Delete menu if category exist.
     * @param $oldSlug
     * @param $oldType
     * @throws \Exception
     */
    public function deleteCategoryFromMenu($oldSlug, $oldType)
    {
        try {
            Menu::where([
                ['slug', $oldSlug],
                ['system_link_type_id', $oldType]
            ])->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Delete menu.
     * @param $id
     */
    public function deleteMenuById($id)
    {
        Menu::findOrFail($id)->delete();
    }
}