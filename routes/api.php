<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Backend', 'middleware' => 'auth'], function () {

    Route::post('add-product-event', 'ProductController@addProductEvent');
});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {
    // delete category image.
    Route::post('category/delete-image', 'ApiCategoryController@deleteImage');
    // delete post image.
    Route::post('post/delete-image', 'ApiPostController@deleteImage');
    // add posts group.
    Route::post('post/add-group', 'ApiPostController@addGroup');
    // remove posts group.
    Route::post('post/remove-group', 'ApiPostController@removeGroup');
    // delete landing page data image.
    Route::post('landing/delete-image', 'ApiPostController@deleteImageLanding');
    // add attribute.
    Route::post('add-attribute', 'ApiAttributeController@addAttribute');
    // get attribute.
    Route::get('get-attribute/{type}','ApiAttributeController@getAttribute');
    // delete product image.
    Route::post('product/delete-image', 'ApiProductController@deleteImage');
    // set product cover image.
    Route::post('set-cover-product', 'ApiProductController@setCoverImage');
    // create menu.
    Route::post('create-menu', 'ApiMenuController@createMenuGroup');
    // add category to menu.
    Route::post('add-category', 'ApiMenuController@addCategory');
    // add page to menu.
    Route::post('add-page', 'ApiMenuController@addPage');
    // add custom to menu.
    Route::post('add-custom', 'ApiMenuController@addCustom');
    // get menu by group to reload after change menu.
    Route::get('get-menu/{idGroup}', 'ApiMenuController@getTemplateMenuByGroup');
    // get list menu group to reload after create menu group.
    Route::get('get-list-menu', 'ApiMenuController@getListMenu');
    // delete menu.
    Route::post('delete-menu', 'ApiMenuController@deleteMenu');
    // update sort.
    Route::post('update-sort', 'ApiMenuController@sort');
    // delete file setting.
    Route::post('delete-file-setting', 'ApiOptionController@deleteFile');
    // delete avatar comment.
    Route::post('comment/delete-image', 'ApiCommentController@deleteAvatar');
});
