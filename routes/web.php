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
/*Peternakan*/
Route::resource('dataternak', 'peternakan\dataTernakController');
Route::get('tabelternak', 'peternakan\dataTernakController@tabelternak')->name('tabel.ternak');
Route::get('cekternak/{id}', 'peternakan\dataTernakController@cekternak');

Route::resource('datapeternak', 'peternakan\peternakController');
Route::get('tabelpeternak', 'peternakan\peternakController@tabelpeternak')->name('tabel.peternak');

Route::resource('kelompokpeternak', 'peternakan\kelompokpeternakController');
Route::get('tabelkelompokpeternak', 'peternakan\kelompokpeternakController@tabelkelompokpeternak')->name('tabel.kelompokpeternak');

Route::resource('keanggotaanpeternak', 'peternakan\keanggotaanController');
Route::get('tabelkeanggotaanpeternak', 'peternakan\keanggotaanController@tabelpokter')->name('tabel.pokter');

Route::resource('kepemilikan', 'peternakan\kepemilikanController');
Route::get('tabelkepemilikan', 'peternakan\kepemilikanController@tabelkepemilikan')->name('tabel.kepemilikan');
Route::get('ceknik/{id}', 'peternakan\kepemilikanController@ceknik');

//Route::resource('kotoranternak', 'peternakan\kotoraternakController');
Route::resource('hasilpeternakan', 'peternakan\hasilpeternakanController');
Route::get('tabelhasil', 'peternakan\hasilpeternakanController@tabelhasil')->name('tabel.hasil');
Route::get('tabelhasilpeternakan', 'peternakan\hasilpeternakanController@tabelcaripeternak')->name('tabel.caripeternak');
Route::get('caripeternak', 'peternakan\hasilpeternakanController@cari')->name('hasilpeternakan.cari');



/* Pertanian */
Route::post('/dataProvinsi/{id}', 'dataPengunjungController@dataProvinsi')->name('data.provinsi');
Route::resource('datatanaman', 'pertanian\datatanamanController');
Route::get('tabeltanaman', 'pertanian\datatanamanController@tabeltanaman')->name('tabel.tanaman');

Route::resource('datapetani', 'pertanian\petaniController');
Route::get('tabelpetani', 'pertanian\petaniController@tabelpetani')->name('tabel.petani');
// Route::post('getdesa/{id}', 'pertanian\petaniController@getdesa')->name('getdesa');

Route::resource('kelompokpetani', 'pertanian\kelompokpetaniController');
Route::get('tabelkelompokpetani', 'pertanian\kelompokpetaniController@tabelkelompokpetani')->name('tabel.kelompokpetani');

Route::resource('keanggotaanpetani', 'pertanian\keanggotaantaniController');
Route::get('tabelkeanggotaan', 'pertanian\keanggotaantaniController@tabelpoktan')->name('tabel.poktan');
Route::get('cekniktani/{id}', 'pertanian\keanggotaantaniController@cekniktani');

Route::resource('hasilpertanian', 'pertanian\hasilpertanianController');
Route::get('tabelhasil', 'pertanian\hasilpertanianController@tabelhasil')->name('tabel.hasil');
Route::get('tabelhasilpertanian', 'pertanian\hasilpertanianController@tabelcaritani')->name('tabel.caritani');
Route::get('caripetani', 'pertanian\hasilpertanianController@cari')->name('hasilpertanian.cari');


/* Ekonomi */

Route::resource('pelakuekonomi', 'ekonomi\pelakuController');
Route::get('pelakuekonomi', 'ekonomi\pelakuController@tabelpelaku')->name('tabel.ekonomi');

//dependency
Route::post('/datadesa/{id}', 'peternakan\kelompokpeternakController@datadesa');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
