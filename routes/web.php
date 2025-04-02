<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');
Route::get('/some-route', 'SomeRouteController@index');

Route::get('/word', 'HomeController@word');
Route::get('/masuk', ['middleware' => 'login_redirector', 'uses' => 'LoginController@index']);
Route::post('/masuk', ['middleware' => 'login_redirector', 'uses' => 'LoginController@verify']);
Route::get('/keluar', 'LoginController@logout');

// User
Route::get('/daftar', ['middleware' => 'login_redirector', 'uses' => 'RegisterController@index']);
Route::post('/daftar', ['middleware' => 'login_redirector', 'uses' => 'RegisterController@store']);

Route::get('/siswa', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\HomeController@index']);
Route::get('/siswa/redirector', ['middleware' => ['login'], 'uses' => 'Siswa\RedirectorController@getter']);

Route::get('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PembekasanController@index']);
Route::post('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PembekasanController@store']);
Route::put('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PembekasanController@perbaharui']);

Route::get('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\SekolahController@index']);
Route::post('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\SekolahController@store']);
Route::put('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\SekolahController@perbaharui']);

Route::get('/siswa/orangtua', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\OrangtuaController@index']);
Route::post('/siswa/orangtua', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\OrangtuaController@store']);
Route::put('/siswa/orangtua', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\OrangtuaController@perbaharui']);

Route::get('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PersetujuanController@index']);
Route::post('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PersetujuanController@store']);
Route::put('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PersetujuanController@perbaharui']);

Route::get('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PembayaranController@index']);
Route::post('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PembayaranController@store']);
Route::put('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\PembayaranController@perbaharui']);

Route::get('/siswa/selesai', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\SelesaiController@index']);
Route::get('/siswa/download', ['middleware' => ['login'], 'uses' => 'Siswa\SelesaiController@download']);


Route::get('/change', ['middleware' => 'login', 'uses' => 'LoginController@change']);
Route::post('/change', ['middleware' => 'login', 'uses' => 'LoginController@updatePassword']);

// Admin routes
Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth'
], function () {
    Route::get('', ['uses' => 'Admin\HomeController@index']);
    Route::post('/add', ['middleware' => 'login', 'uses' => 'RegisterController@addAdmin']);
    Route::get('/add', ['middleware' => 'login', 'uses' => 'RegisterController@newAdmin']);
    Route::get('/data', ['uses' => 'Admin\DataController@all']);
    Route::get('/search', ['uses' => 'Admin\HomeController@search']);
    Route::get('/validasi', ['uses' => 'Admin\DataController@validasi']);
    Route::post('/validator', ['uses' => 'Admin\DataController@validator']);
    Route::post('/delete', ['uses' => 'Admin\DataController@delete']);


    // Export
    Route::get('export', ['uses' => 'Admin\ExportController@index']);
    Route::get('export/excel', ['uses' => 'Admin\ExportController@toExcel']);
    Route::get('export/{regid}/bukuinduk', ['uses' => 'Admin\ExportController@bukuInduk']);
    Route::get('data/jurusan/{jurusan}', ['uses' => 'Admin\ViewerController@jurusan']);

    Route::get('data/{status}', ['uses' => 'Admin\DataController@status']);

    Route::get('detail/{regid}/regenerate', ['uses' => 'Admin\DataController@regenerate']);
    Route::get('detail/{regid}', ['uses' => 'Admin\DataController@detail']);


    Route::get('perbaharui/biodata/{regid}', ['uses' => 'Admin\EditController@editDataDiri']);
    Route::post('perbaharui/biodata/{regid}', ['uses' => 'Admin\UpdateController@updateDataDiri']);

    Route::get('perbaharui/ayah/{regid}', ['uses' => 'Admin\EditController@editDataAyah']);
    Route::post('perbaharui/ayah/{regid}', ['uses' => 'Admin\UpdateController@updateDataAyah']);

    Route::get('perbaharui/ibu/{regid}', ['uses' => 'Admin\EditController@editDataIbu']);
    Route::post('perbaharui/ibu/{regid}', ['uses' => 'Admin\UpdateController@updateDataIbu']);

    Route::get('perbaharui/wali/{regid}', ['uses' => 'Admin\EditController@editDataWali']);
    Route::post('perbaharui/wali/{regid}', ['uses' => 'Admin\UpdateController@updateDataWali']);

    Route::get('perbaharui/sekolah/{regid}', ['uses' => 'Admin\EditController@editDataSekolah']);
    Route::post('perbaharui/sekolah/{regid}', ['uses' => 'Admin\UpdateController@updateDataSekolah']);

    Route::get('perbaharui/file/{type}/{regid}', ['uses' => 'Admin\EditController@editDataFile']);
    Route::post('perbaharui/file/{type}/{regid}', ['uses' => 'Admin\UpdateController@updateDataFile']);
});




