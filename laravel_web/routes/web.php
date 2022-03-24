<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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

Route::get('/', function () {
    return view('index_content');
})->name('home');

Route::get('logout', function () {
    Session::flush();
    return redirect(route('home'));
})->name('LogOut');

Route::get('login','NguoiDungController@getLogin')->name('getLogin');
Route::post('login','NguoiDungController@postLogin')->name('postLogin');
Route::post('register','NguoiDungController@Register')->name('postRegister');
Route::get('register', function () {
    return view('dangky');
})->name('register');

Route::get('user/list','NguoiDungController@index');
Route::get('user', function () {
    return view('nguoidung');
})->name('listUS');
Route::get('user/edit/{id}','NguoiDungController@edit');
Route::post('user/edit/{id}','NguoiDungController@update');
Route::post('user/add','NguoiDungController@add');
Route::post('user/del/{id}','NguoiDungController@delete');
Route::get('user/add', function () {
    return view('nguoidung_add');
})->name('addUS');

Route::get('chude/list','ChuDeController@index');
Route::get('chude', function () {
    return view('chude');
})->name('dsChuDe');

Route::post('chude/add','ChuDeController@add');
Route::get('chude/add', function () {
    return view('chude_add');
})->name('addChude');

Route::get('chude/edit/{id}','ChuDeController@edit');
Route::post('chude/edit/{id}','ChuDeController@update');
Route::post('chude/del/{id}','ChuDeController@delete');

Route::get('baiviet/create', function () {
    return view('baiviet_create');
})->name('createBaiViet');

Route::post('baiviet/create','BaiVietController@add');
Route::post('noidung/add','NoiDungController@add');
Route::post('image/add/{id}','ImagesController@add');

Route::post('link/add','LinkController@add');

Route::get('baiviet/list','BaiVietController@index');
Route::get('baiviet/top10','BaiVietController@top10');

Route::post('baiviet/lienquan/{id}','BaiVietController@baivietlienquan');
Route::post('baiviet/see/{id}','BaiVietController@see');
Route::post('baiviet/detail/{id}','BaiVietController@detail');
Route::get('baiviet/detail/{id}', function () {
    return view('baiviet_detail');
});

Route::post('search/chude/{id}','BaiVietController@search_chude');
Route::get('search/chude/{id}', function () {
    return view('search_theloai');
});

Route::post('search/{text}','BaiVietController@search');
Route::get('search/{text}', function () {
    return view('search_result');
});

Route::get('baiviet/list/{id}','BaiVietController@baivietTG');
Route::get('baiviet', function () {
    return view('baiviet');
})->name('listBaiViet');

Route::get('baiviet/edit/{id}','BaiVietController@edit');
Route::post('baiviet/edit/{id}','BaiVietController@update');
Route::get('link/edit/{id}','LinkController@edit');
Route::post('link/edit/{id}','LinkController@update');

Route::get('image/edit/{id}','ImagesController@edit');
Route::post('image/edit/{id}/baiviet/{idbv}','ImagesController@update');
Route::post('baiviet/del/{id}','BaiVietController@delete');

Route::post('comment/{id}','BinhLuanController@add');

Route::post('baiviet/manage','BaiVietController@baivietManage');
Route::get('baiviet/manage', function () {
    return view('baiviet_manager');
})->name('baivietManage');

Route::post('baiviet/status/{id}','BaiVietController@status');
Route::get('binhluan/manage/list','BinhLuanController@index');
Route::get('binhluan/manage', function () {
    return view('binhluan_manage');
})->name('binhluanManage');

Route::post('binhluan/delete/{id}','BinhLuanController@delete');

