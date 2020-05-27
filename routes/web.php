<?php
$router->get('/', 'HomeController@index');
$router->get('/masuk', ['middleware' => 'loginRedirector', 'uses' => 'LoginController@index']);
$router->post('/masuk', ['middleware' => 'loginRedirector', 'uses' => 'LoginController@verify']);
$router->get('/keluar', 'LoginController@logout');

// User
$router->get('/daftar', ['middleware' => 'loginRedirector', 'uses' => 'RegisterController@index']);
$router->post('/daftar', ['middleware' => 'loginRedirector', 'uses' => 'RegisterController@store']);

$router->get('/siswa', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\HomeController@index']);

$router->get('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembekasanController@index']);
$router->post('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembekasanController@store']);
$router->put('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembekasanController@perbaharui']);

$router->get('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\SekolahController@index']);
$router->post('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\SekolahController@store']);
$router->put('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\SekolahController@perbaharui']);

$router->get('/siswa/orangtua', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\OrangtuaController@index']);
$router->post('/siswa/orangtua', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\OrangtuaController@store']);
$router->put('/siswa/orangtua', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\OrangtuaController@perbaharui']);

$router->get('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PersetujuanController@index']);
$router->post('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PersetujuanController@store']);
$router->put('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PersetujuanController@perbaharui']);

$router->get('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembayaranController@index']);
$router->post('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembayaranController@store']);
$router->put('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembayaranController@perbaharui']);

$router->get('/siswa/selesai', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\SelesaiController@index']);
$router->get('/siswa/download', ['middleware' => ['login'], 'uses' =>'Siswa\SelesaiController@download']);

// Admin routes
$router->get('/admin', ['middleware' => 'role', 'uses' => 'Admin\HomeController@index']);
$router->get('/change', ['middleware' => 'login', 'uses' => 'LoginController@change']);
$router->post('/change', ['middleware' => 'login', 'uses' => 'LoginController@updatePassword']);
$router->post('/admin/add', ['middleware' => 'login', 'uses' => 'RegisterController@addAdmin']);
$router->get('/admin/add', ['middleware' => 'login', 'uses' => 'RegisterController@newAdmin']);
$router->get('/admin/data', ['middleware' => 'role', 'uses' => 'Admin\DataController@all']);
$router->get('/admin/search', ['middleware' => 'role', 'uses' => 'Admin\HomeController@search']);
$router->get('/admin/validasi', ['middleware' => 'role', 'uses' => 'Admin\DataController@validasi']);
$router->post('/admin/validator', ['middleware' => 'role', 'uses' => 'Admin\DataController@validator']);
$router->get('/admin/data/{status}', ['middleware' => 'role', 'uses' => 'Admin\DataController@status']);
$router->get('/admin/detail/{regid}', ['middleware' => 'role', 'uses' => 'Admin\DataController@detail']);
$router->get('/admin/detail/{regid}/regenerate', ['middleware' => 'role', 'uses' => 'Admin\DataController@regenerate']);


$router->get('/admin/perbaharui/biodata/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataDiri']);
$router->post('/admin/perbaharui/biodata/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataDiri']);

$router->get('/admin/perbaharui/ayah/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataAyah']);
$router->post('/admin/perbaharui/ayah/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataAyah']);

$router->get('/admin/perbaharui/ibu/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataIbu']);
$router->post('/admin/perbaharui/ibu/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataIbu']);

$router->get('/admin/perbaharui/wali/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataWali']);
$router->post('/admin/perbaharui/wali/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataWali']);

$router->get('/admin/perbaharui/sekolah/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataSekolah']);
$router->post('/admin/perbaharui/sekolah/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataSekolah']);

$router->get('/admin/perbaharui/file/{type}/{regid}', ['middleware' => 'role', 'uses' => 'Admin\EditController@editDataFile']);
$router->post('/admin/perbaharui/file/{type}/{regid}', ['middleware' => 'role', 'uses' => 'Admin\UpdateController@updateDataFile']);


