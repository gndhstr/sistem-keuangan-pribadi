<?php

use Illuminate\Support\Facades\Auth; //class untuk Route
use Illuminate\Support\Facades\Route; //class untuk auth

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
route::get("/","LoginController@login" )->name("index");
route::post("/","LoginController@authenticate")->name("authenticate");
// Route::post('/login', 'App\Http\Controllers\LoginController@authenticate')->name("authenticate");
route::get('/logout', 'LoginController@logout')->name('logout');

// 
Route::get('/starter', function () {
    return view('starter');
});
Auth::routes();

Route::prefix("admin")->middleware("auth", "role:1")->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    // divisi
    Route::get("/divisi","DivisiController@index")->name("daftarDivisi");
    Route::get("/divisi/create","DivisiController@create")->name("createDivisi");
    Route::post("/divisi/store","DivisiController@store")->name("storeDivisi");
    Route::get("/divisi/{divisi}/edit","DivisiController@edit")->name("editDivisi");
    Route::post("/divisi/{divisi}/update", "DivisiController@update")->name("updateDivisi");
    Route::get("/divisi/{divisi}/delete", "DivisiController@destroy")->name("deleteDivisi");

    // kategori
    Route::get("/kategori","KategoriController@index")->name("daftarKategori");
    Route::get("/kategori/create","KategoriController@create")->name("createKategori");
    Route::post("/kategori/store","KategoriController@store")->name("storeKategori");
    Route::get("/kategori/{kategori}/edit","KategoriController@edit")->name("editKategori");
    Route::post("/kategori/{kategori}/update", "KategoriController@update")->name("updateKategori");
    Route::get("/kategori/{kategori}/delete", "KategoriController@destroy")->name("deleteKategori");

    // role
    Route::get("/role","RoleController@index")->name("daftarRole");
    Route::get("/role/create","RoleController@create")->name("createRole");
    Route::post("/role/store","RoleController@store")->name("storeRole");
    Route::get("/role/{role}/edit","RoleController@edit")->name("editRole");
    Route::post("/role/{role}/update", "RoleController@update")->name("updateRole");
    Route::get("/role/{role}/delete", "RoleController@destroy")->name("deleteRole");

    //User
    Route::get("/user","UserController@index")->name("daftarUser");
    Route::get("/user/create","UserController@create")->name("createUser");
    Route::post("/user/store","UserController@store")->name("storeUser");
    Route::get("/user/{user}/edit","UserController@edit")->name("editUser");
    Route::post("/user/{user}/update", "UserController@update")->name("updateUser");
    Route::get("/user/{user}/delete", "UserController@destroy")->name("deleteUser");

    //pemasukan
    Route::get('/pemasukan', 'PemasukanController@index')->name('daftarPemasukan');
    Route::get('/pemasukan/create', 'PemasukanController@create')->name('createPemasukan');
    Route::post('/pemasukan/store', 'PemasukanController@store')->name('storePemasukan');
    Route::get('/pemasukan/{pemasukan}/edit', 'PemasukanController@edit')->name('editPemasukan');
    Route::put('/pemasukan/{tbl_pemasukan}', 'PemasukanController@update')->name('updatePemasukan');
    Route::get('/pemasukan/{pemasukan}/delete', 'PemasukanController@destroy')->name('deletePemasukan');
    
});

Route::prefix('direktur')->middleware("auth", "role:2")->group(function () {
    Route::redirect('/', 'direktur/dashboard');
    Route::get('/dashboard', 'DirekturController@dashboard');
    Route::get('/cashflow', 'DirekturController@cashflow');
    Route::get('/anggaran', 'DirekturController@anggaran');
    Route::get('/karyawan', 'DirekturController@karyawan');

    Route::get('/cashflow/{id}/data', 'DirekturController@cashflowDivisi')->name('cashflowDivisi');    
    // Route::get('/karyawan/{id}', 'DirekturController@karyawan');
});

Route::prefix('manajer')->middleware("auth", "role:3")->group(function () {
    Route::get("/","ManajerController@index")->name("dashboardManajer");

    // CRUD Anggaran
    Route::get("/anggaran","AnggaranController@index")->name("anggaran");
    Route::get("/anggaran/create","AnggaranController@create")->name("createAnggaran");
    Route::post("/anggaran/store","AnggaranController@store")->name("storeAnggaran");
    Route::get("/anggaran/{anggaran}/edit","AnggaranController@edit")->name("editAnggaran");
    Route::post("/anggaran/{anggaran}/update", "AnggaranController@update")->name("updateAnggaran");
    Route::get("/anggaran/{anggaran}/delete", "AnggaranController@destroy")->name("deleteAnggaran");
    
    // CRUD Karyawan
    Route::get("/karyawan","KaryawanController@index")->name("karyawan");
    Route::post("/karyawan/store","KaryawanController@store")->name("storeKaryawan");
    Route::post("/karyawan/update","KaryawanController@update")->name("updateKaryawan");

    //CRUD Kategori
    Route::get("/kategori","KategoriController@index")->name("daftarKategori");
    Route::post("/kategori/store","KategoriController@store")->name("storeKategori");
    Route::post("/kategori/{kategori}/update", "KategoriController@update")->name("updateKategori");
    Route::get("/kategori/{kategori}/delete", "KategoriController@destroy")->name("deleteKategori");
});

// Route::get('dashboards', 'DashboardController@index')->middleware('admin');
