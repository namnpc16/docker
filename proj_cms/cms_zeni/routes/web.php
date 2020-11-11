<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Backend routes */
Route::middleware(['AccessLogin', 'CheckLogin'])->namespace('Admin')->prefix('admin')->group(function () {

    // route group pages
    Route::group(['prefix' => 'page'], function () {
        Route::get('/', 'PageController@index')->name('list.page');
        Route::post('/', 'PageController@index')->name('list.page');
        Route::get('/create', 'PageController@create')->name('create.page');
        Route::post('/store', 'PageController@store')->name('store.page');
        Route::get('/edit/{id}', 'PageController@edit')->name('edit.page');
        Route::post('/update/{id}', 'PageController@update')->name('update.page');
        Route::post('/del', 'PageController@delete')->name('del.page');
    });
    // route group users
    Route::group(['prefix' => 'user', 'middleware' => 'role'], function () {
        Route::get('/', 'UserController@index');
        Route::post('/', 'UserController@index')->name('list.user');
        Route::get('/create', 'UserController@create')->name('create.user');
        Route::post('/store', 'UserController@store')->name('store.user');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit.user');
        Route::post('/update/{id}', 'UserController@update')->name('update.user');
        Route::post('/del', 'UserController@delete')->name('del.user');
        Route::get('/trash', 'UserController@soft')->name('soft.user');
        Route::post('/trash', 'UserController@soft')->name('soft.user');
        Route::post('/restore', 'UserController@restore')->name('restore.user');
    });

    // login, logout
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login')->withoutMiddleware('CheckLogin');
    Route::post('/login', 'Auth\LoginController@login')->name('admin.login')->withoutMiddleware('CheckLogin');
    Route::get('/logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
    // forgot password
    Route::get('/forgot', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.forgot')->withoutMiddleware('CheckLogin');

    
    
    /*Admin categories*/
    Route::group(['prefix' => 'cate'], function(){
        Route::get('/', 'CategoryController@index');
        Route::post('/', 'CategoryController@index')->name('cate.listcate');
        Route::get('viewEditcate/{id_edit}', 'CategoryController@getdatabyIdeditcate')->name('cate.getidcate');
        Route::get('addCateView', function () { return view('admin.category.category_add'); })->name('cate.addview');
        Route::post('addcate', ['as'=>'cate.addcate', 'uses'=>'CategoryController@addcate']);
        Route::post('editcate', 'CategoryController@editcate')->name('cate.editcate');
        Route::post('deletecate', 'CategoryController@deletecate')->name('cate.delcate');
        //Route::get('test', 'CategoryController@test');
    });

    /*Admin posts*/
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', 'PostController@index');
        Route::post('/', 'PostController@index')->name('listView.posts');
        Route::get('addView', function () { return view('admin.posts.add_post'); });
        Route::post('adddata', 'PostController@addposts')->name('adddata.posts');
        Route::post('delPost', 'PostController@delData')->name('del.posts');
        Route::get('editView/{id}', 'PostController@editDataById');
        Route::post('editData', ['as' =>'edit.posts', 'uses'=>'PostController@editData']);
    });
    
    /* */
});
Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.reset');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

