<?php

namespace App\Http\Controllers\Api;

use App\Services\MenuServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiMenuController extends Controller
{
    private $menuServices;

    public function __construct(MenuServices $menuServices)
    {
        parent::__construct();

        $this->menuServices = $menuServices;
    }

    /**
     * Create menu group.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMenuGroup(Request $request)
    {
        try {
            $this->menuServices->createMenuGroup($request->all());

            return response()->json(['message' => 'Your menu has been created!'], 200);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    /**
     * Get all menu group to reload after create menu group.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getListMenu()
    {
        $menuGroups = $this->menuServices->getAllMenuGroups();

        return view('backend.menu.partial._menu_select', [
            'menuGroups' => $menuGroups
        ]);
    }

    /**
     * Add category to menu.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCategory(Request $request)
    {
        if (!$request->has(['ids', 'idMenuGroup'])) {
            throw new NotFoundHttpException('Missing params');
        }

        try {
            $this->menuServices->addCategoryToMenu($request->all());

            return response()->json(['message' => 'Add successful'], 200);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    /**
     * Add page to menu.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPage(Request $request)
    {
        if (!$request->has(['ids', 'idMenuGroup'])) {
            throw new NotFoundHttpException('Missing params');
        }

        try {
            $this->menuServices->addPageToMenu($request->all());

            return response()->json(['message' => 'Add successful'], 200);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    /**
     * Add custom to menu.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCustom(Request $request)
    {
        if (!$request->has(['label', 'url', 'idMenuGroup'])) {
            throw new NotFoundHttpException('Missing params');
        }

        try {
            $this->menuServices->addCustomToMenu($request->all());

            return response()->json(['message' => 'Add successful'], 200);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    /**
     * Delete menu.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMenu(Request $request)
    {
        if (!$request->has(['id'])) {
            throw new NotFoundHttpException('Missing params');
        }

        try {
            $this->menuServices->deleteMenuById($request->id);

            return response()->json(['message' => 'Your item has been deleted'], 200);
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }

    /**
     * Reload menu by group.
     * @param int $idGroup
     * @return string
     */
    public function getTemplateMenuByGroup($idGroup)
    {
        $templateMenu = $this->menuServices->getTemplateMenu($idGroup);

        return $templateMenu;
    }

    /**
     * Sort menu.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sort(Request $request)
    {
        try {
            $this->menuServices->updateSort($request->all());

            return response()->json('Update menu successful');
        } catch (\Exception $exception) {
            return response()->json('Internal Server Error', 500);
        }
    }
}
