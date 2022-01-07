<?php

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
    return view('welcome');
});

Auth::routes();

//Verif
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@auth');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@admin')->name('admin');

//Presensi
Route::get('/presensi', 'PresensiController@index')->name('presensi');
Route::get('/presensiSiswa', 'PresensiController@indexSiswa')->name('presensiSiswa');
Route::get('/print', 'PresensiController@prints');
Route::post('/presensiSiswa/add', 'PresensiController@store');
Route::patch('/presensi/update', 'PresensiController@update');
Route::delete('/presensi/{id_presensi}', 'PresensiController@destroy');
Route::get('/presensi/action', 'PresensiController@action')->name('presensi.action');
Route::get('/presensi/actionSiswa', 'PresensiController@actionSiswa')->name('presensiSiswa.action');

//Kelas
Route::get('/kelas', 'KelasController@index')->name('kelas');
Route::post('/kelas/add', 'KelasController@store');
Route::patch('/kelas/update', 'KelasController@update');
Route::delete('/kelas/{id_kelas}', 'KelasController@destroy');
Route::get('/kelas/action', 'KelasController@action')->name('kelas.action');

//Jenjang
Route::get('/jenjang', 'JenjangController@index')->name('jenjang');
Route::post('/jenjang/add', 'JenjangController@store');
Route::patch('/jenjang/update', 'JenjangController@update');
Route::delete('/jenjang/{id_jenjang}', 'JenjangController@destroy');
Route::get('/jenjang/action', 'JenjangController@action')->name('jenjang.action');

//Mapel
Route::get('/mapel', 'MapelController@index')->name('mapel');
Route::post('/mapel/add', 'MapelController@store');
Route::patch('/mapel/update', 'MapelController@update');
Route::delete('/mapel/{id_mapel}', 'MapelController@destroy');
Route::get('/mapel/action', 'MapelController@action')->name('mapel.action');

//Tutor
Route::get('/tutor', 'TutorController@index')->name('tutor');
Route::post('/tutor/add', 'TutorController@store');
Route::patch('/tutor/update', 'TutorController@update');
Route::delete('/tutor/{nip}', 'TutorController@destroy');
Route::get('/tutor/action', 'TutorController@action')->name('tutor.action');

//Siswa
Route::get('/siswa', 'SiswaController@index')->name('siswa');
Route::post('/siswa/add', 'SiswaController@store');
Route::patch('/siswa/update', 'SiswaController@update');
Route::delete('/siswa/{nim}', 'SiswaController@destroy');
Route::get('/siswa/action', 'SiswaController@action')->name('siswa.action');