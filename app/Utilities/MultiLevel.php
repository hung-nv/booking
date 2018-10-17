<?php

namespace App\Utilities;


trait MultiLevel
{
    /**
     * Get template checkbox category.
     * @param $category
     * @param null $selectedId
     * @param null $parentId
     * @param string $name
     * @param int $level
     * @param array $template
     * @return string
     * @throws \Throwable
     */
    public function getTemplateCheckboxCategory($category, $selectedId = null, $name = 'parent', $parentId = null, $level = 0, &$template = [])
    {
        if (!empty($category)) {

            foreach ($category as $key => $item) {

                if ($item->parent_id == $parentId) {

                    $template[] = view('backend.post.partial._checkboxCategory', [
                        'item' => $item,
                        'selectedId' => $selectedId,
                        'level' => $level,
                        'name' => $name
                    ])->render();

                    unset($category[$key]);

                    $this->getTemplateCheckboxCategory($category, $selectedId, $name, $item->id, $level + 1, $template);
                }
            }
        }

        return implode('', $template);
    }

    /**
     * Get template nestable menu.
     * @param $dataMenus
     * @param null $parentId
     * @param array $template
     * @return string
     * @throws \Throwable
     */
    public function getTemplateMenuNestable($dataMenus, $parentId = null, &$template = [])
    {
        $children = [];

        if (count($dataMenus) > 0) {
            foreach ($dataMenus as $key => $item) {
                // if child menu.
                if ($item->parent_id == $parentId) {
                    $children[] = $item;

                    // unset child menu after set variable.
                    unset($dataMenus[$key]);
                }
            }
        }

        // get child menu to continue.
        if (isset($children) && $children) {
            $template[] = '<ol class="dd-list">';

            foreach ($children as $item) {
                $template[] = view('backend.partials._menu', [
                    'item' => $item
                ])->render();

                $this->getTemplateMenuNestable($dataMenus, $item->id, $template);
            }

            $template[] = '</ol>';
        }

        return implode('', $template);
    }
}