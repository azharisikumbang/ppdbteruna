<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', 'HomeController@index');
$router->get('/masuk', 'LoginController@index');
$router->post('/masuk', 'LoginController@verify');
$router->get('/keluar', 'LoginController@logout');

// User
$router->get('/daftar', 'RegisterController@index');
$router->post('/daftar', 'RegisterController@store');

$router->get('/siswa', ['middleware' => ['login', 'reg'], 'uses' => 'Siswa\HomeController@index']);

$router->get('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembekasanController@index']);
$router->post('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembekasanController@store']);
$router->put('/siswa/pemberkasan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembekasanController@perbaharui']);

$router->get('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\SekolahController@index']);
$router->post('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\SekolahController@store']);
$router->put('/siswa/sekolah', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\SekolahController@perbaharui']);

$router->get('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PersetujuanController@index']);
$router->post('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PersetujuanController@store']);
$router->put('/siswa/persetujuan', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PersetujuanController@perbaharui']);

$router->get('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembayaranController@index']);
$router->post('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembayaranController@store']);
$router->put('/siswa/pembayaran', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\PembayaranController@perbaharui']);

$router->get('/siswa/selesai', ['middleware' => ['login', 'reg'], 'uses' =>'Siswa\SelesaiController@index']);
$router->get('/siswa/download', ['middleware' => ['login'], 'uses' =>'Siswa\SelesaiController@download']);

// Admin routes
$router->get('/admin', [
    'middleware' => 'role',
    'uses' => 'Admin\HomeController@index'
]);
$router->get('/admin/search', [
    'middleware' => 'role',
    'uses' => 'Admin\HomeController@search'
]);
$router->post('/admin/all', [
    // 'middleware' => 'role',
    'uses' => 'Admin\HomeController@getAll'
]);

$router->get('/admin/validasi', [
    'middleware' => 'role',
    'uses' => 'Admin\DataController@validasi'
]);

$router->post('/admin/validator', [
    'middleware' => 'role',
    'uses' => 'Admin\DataController@validator'
]);

$router->get('/admin/data', [
    'middleware' => 'role',
    'uses' => 'Admin\DataController@all'
]);

$router->get('/admin/data/{status}', [
    'middleware' => 'role',
    'uses' => 'Admin\DataController@status'
]);

$router->get('/admin/detail/{regid}', [
    'middleware' => 'role',
    'uses' => 'Admin\DataController@detail'
]);

$router->post('/change', [
    'middleware' => 'login',
    'uses' => 'LoginController@updatePassword'
]);

$router->get('/change', [
    'middleware' => 'login',
    'uses' => 'LoginController@change'
]);

$router->get('/admin/add', [
    'middleware' => 'login',
    'uses' => 'RegisterController@newAdmin'
]);

$router->post('/admin/add', [
    'middleware' => 'login',
    'uses' => 'RegisterController@addAdmin'
]);


