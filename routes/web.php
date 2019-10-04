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

Route::get('/dashboard', function () {
    return view('dashboard');
});
/*peternakan*/
Route::resource('dataternak', 'peternakan\dataternakController');
Route::get('tabelternak', 'peternakan\dataternakController@tabelternak')->name('tabel.ternak');

Route::resource('datapeternak', 'peternakan\peternakController');
Route::get('datapeternak', 'peternakan\peternakController@tabelpeternak')->name('tabel.peternak');

Route::resource('kelompokpeternak', 'peternakan\kelompokpeternakController');
Route::get('kelompokpeternak', 'peternakan\kelompokpeternakController@tabelkelompokpeternak')->name('tabel.kelompokpeternak');

Route::resource('keanggotaanpeternak', 'peternakan\keanggotaanController');

Route::resource('kepemilikan', 'peternakan\kepemilikanController');
Route::get('kepemilikan', 'peternakan\kepemilikanController@tabelkepemilikan')->name('tabel.kepemilikan');
Route::get('ceknik/{id}', 'peternakan\kepemilikanController@ceknik');


/* Pertanian */

Route::resource('datatanaman', 'pertanian\datatanamanController');
Route::get('datatanaman', 'pertanian\datatanamanController@tabeltanaman')->name('tabel.tanaman');

Route::resource('datapetani', 'pertanian\petaniController');
Route::get('datapetani', 'pertanian\petaniController@tabelpetani')->name('tabel.petani');

Route::resource('kelompokpetani', 'pertanian\kelompokpetaniController');
Route::get('kelompokpetani', 'pertanian\kelompokpetaniController@tabelkelompokpetani')->name('tabel.kelompokpetani');

Route::resource('keanggotaanpetani', 'pertanian\keanggotaantaniController');


/* Ekonomi */

Route::resource('pelakuekonomi', 'ekonomi\pelakuController');
Route::get('pelakuekonomi', 'ekonomi\pelakuController@tabelpelaku')->name('tabel.ekonomi');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
