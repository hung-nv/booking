<?php

Route::get('/administrator', function () {
    return view('backend.auth.login');
});

Route::group(['namespace' => 'Frontend'], function () {
    // route homepage.
    Route::get('/', ['as' => 'homepage', 'uses' => 'HomepageController@index']);
    // route list posts.
    Route::get('category', ['as' => 'post.list', 'uses' => 'PostController@index']);

    Route::get('single', ['as' => 'post.details', 'uses' => 'PostController@details']);
});

Route::group(['prefix' => 'administrator', 'namespace' => 'Backend'], function () {
    // route login.
    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getLogin']);
    // route login.
    Route::post('login', ['as' => 'login', 'uses' => 'LoginController@postLogin']);
    // route logout.
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
});

Route::group(['prefix' => 'administrator', 'middleware' => 'auth', 'namespace' => 'Backend'], function () {
    Route::group(['middleware' => 'checkrole:1|2'], function () {
        Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminSiteController@index']);

        // route edit account.
        Route::get('user/update-account', ['as' => 'user.updateAccount', 'uses' => 'UserController@updateAccount']);

        // route update account.
        Route::put('user/update-account', ['as' => 'user.putUpdateAccount', 'uses' => 'UserController@account']);

        // route resource post.
        Route::resource('article', 'ArticleController');

        // route resource category.
        Route::resource('category', 'CategoryController');

        // route resource page.
        Route::resource('page', 'PageController', ['except' => ['show']]);

        // route resource comment.
        Route::resource('comment', 'CommentController', ['except' => ['show']]);

        // route resource services.
        Route::resource('services', 'ServicesController', ['except' => ['show']]);

        // route resource services
        Route::resource('services', 'ServicesController', ['except' => ['show']]);

        // route create landing page.
        Route::get('page/landing', ['as' => 'page.landing', 'uses' => 'PageController@landing']);

        // route store landing page.
        Route::post('page/landing', ['as' => 'page.storeLanding', 'uses' => 'PageController@storeLanding']);

        // route edit landing page.
        Route::get('page/{id}/editLanding', ['as' => 'page.editLanding', 'uses' => 'PageController@editLanding']);

        // route update landing page.
        Route::put('page/{id}/updateLanding', ['as' => 'page.updateLanding', 'uses' => 'PageController@updateLanding']);

        // route for product.
        Route::resource('product', 'ProductController', ['except' => ['show']]);

        // route copy product.
        Route::get('product/copy/{id}', ['as' => 'product.copy', 'uses' => 'ProductController@copy']);

        // route copy and edit product.
        Route::get('product/copy-edit/{id}', ['as' => 'product.copyedit', 'uses' => 'ProductController@copyAndEdit']);

        // route resource attribute value.
        Route::resource('attributeValue', 'AttributeValueController', ['only' => ['index', 'destroy']]);

        // route resource event.
        Route::resource('event', 'EventController');
    });

    Route::group(['middleware' => 'checkrole:1'], function () {
        // route resource menu system.
        Route::resource('menuSystem', 'MenuSystemController', ['except' => ['show']]);

        // route resource user.
        Route::resource('user', 'UserController');

        // route resource setting.
        Route::resource('setting', 'SettingController', ['only' => ['index', 'store']]);

        // route setting menu.
        Route::get('menu', ['as' => 'setting.menu', 'uses' => 'SettingController@menu']);
    });
});

/**
 * Resize image.
 */
Route::get('img/{w}/{h}/{src}', function ($w, $h, $src) {
    $imagePath = public_path() . '/' . $src;

    $img = Image::cache(function ($image) use ($w, $h, $imagePath) {
        return $image->make($imagePath)->resize($w, $h);
    });

    return Response::make($img, 200, ['Content-Type' => 'image/jpeg']);
})->where('src', '[A-Za-z0-9\/\.\-\_]+');