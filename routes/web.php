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

// Admin routes
Route::get('/admin', ['middleware' => 'role', 'uses' => 'Admin\HomeController@index']);
Route::get('/change', ['middleware' => 'login', 'uses' => 'LoginController@change']);
Route::post('/change', ['middleware' => 'login', 'uses' => 'LoginController@updatePassword']);
Route::post('/admin/add', ['middleware' => 'login', 'uses' => 'RegisterController@addAdmin']);
Route::get('/admin/add', ['middleware' => 'login', 'uses' => 'RegisterController@newAdmin']);
Route::get('/admin/data', ['middleware' => 'role', 'uses' => 'Admin\DataController@all']);
Route::get('/admin/search', ['middleware' => 'role', 'uses' => 'Admin\HomeController@search']);
Route::get('/admin/validasi', ['middleware' => 'role', 'uses' => 'Admin\DataController@validasi']);
Route::post('/admin/validator', ['middleware' => 'role', 'uses' => 'Admin\DataController@validator']);
Route::post('/admin/delete', ['middleware' => 'role', 'uses' => 'Admin\DataController@delete']);

// Export
Route::get('/admin/export', ['middleware' => 'login', 'uses' => 'Admin\ExportController@index']);
Route::get('/admin/export/excel', ['middleware' => 'login', 'uses' => 'Admin\ExportController@toExcel']);
Route::get('/admin/export/{regid}/bukuinduk', ['middleware' => 'login', 'uses' => 'Admin\ExportController@bukuInduk']);
Route::get('/admin/data/jurusan/{jurusan}', ['middleware' => 'role', 'uses' => 'Admin\ViewerController@jurusan']);

Route::get('/admin/data/{status}', ['middleware' => 'role', 'uses' => 'Admin\DataController@status']);

Route::get('/admin/detail/{regid}/regenerate', ['middleware' => 'role', 'uses' => 'Admin\DataController@regenerate']);
Route::get('/admin/detail/{regid}', ['middleware' => 'role', 'uses' => 'Admin\DataController@detail']);


Route::get('/admin/perbaharui/biodata/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataDiri']);
Route::post('/admin/perbaharui/biodata/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataDiri']);

Route::get('/admin/perbaharui/ayah/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataAyah']);
Route::post('/admin/perbaharui/ayah/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataAyah']);

Route::get('/admin/perbaharui/ibu/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataIbu']);
Route::post('/admin/perbaharui/ibu/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataIbu']);

Route::get('/admin/perbaharui/wali/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataWali']);
Route::post('/admin/perbaharui/wali/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataWali']);

Route::get('/admin/perbaharui/sekolah/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataSekolah']);
Route::post('/admin/perbaharui/sekolah/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataSekolah']);

Route::get('/admin/perbaharui/file/{type}/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataFile']);
Route::post('/admin/perbaharui/file/{type}/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataFile']);


