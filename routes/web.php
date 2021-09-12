<?php

use Illuminate\Support\Facades\Route;

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

//
// ポートフォリオTOP画面
//
Route::get('/',  function () {
	return view('top');
})->name('top');

//
// 翻訳ツール
//
Route::get('/index', 'HomeController@index')->name('user.index');
Route::post('/index', 'HomeController@get_translate')->name('user.translate');
Route::get('/list', 'ListController@index')->name('user.list');
Route::post('/list', 'ListController@search')->name('user.search');
Route::get('/{id}/detail', 'ListController@showDetail')->name('user.detail');


// 管理
Route::get('/admin/login', 'LoginController@index')->name('login');
Route::post('admin/login', 'LoginController@login')->name('login');
Route::get('/admin/top', 'AdminHomeController@index')->name('admin.top');
Route::get('/admin/edit/{id}', 'AdminMessageController@edit')->name('admin.edit');
Route::post('/admin/update/{id}', 'AdminMessageController@update')->name('admin.update');
Route::get('/admin/{id}/detail', 'AdminMessageController@detail')->name('admin.detail');
Route::get('/admin/message', 'AdminMessageController@index')->name('admin.message');
Route::post('admin/register', 'AdminMessageController@store')->name('admin.register');
Route::get('/admin/list', 'AdminMessageController@listIndex')->name('admin.list');


// ホットペッパー
Route::get('/hp', function () {
    return view('user2/index');
});