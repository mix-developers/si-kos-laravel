<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FasilitasKosController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\RatingController;
use App\Models\Kos;
use App\Models\SewaKos;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $title = 'Home';
    $kos = Kos::limit(5)->get();
    return view('pages.index', ['title' => $title, 'kos' => $kos]);
});
Route::get('/kos/{slug}', function ($slug) {
    $kos = Kos::where('slug', $slug)->first();
    $title = 'Kos : ' . $kos->nama_kos;
    return view('pages.detail', ['title' => $title, 'kos' => $kos]);
});
Route::get('/semua-kos', function () {
    $title = 'Semua Kos';
    $kos = Kos::paginate(10);
    return view('pages.semua', ['title' => $title, 'kos' => $kos]);
});
Route::get('/cari-kos', function () {
    $title = 'Cari Kos';
    return view('pages.cari', ['title' => $title]);
});
Route::get('/maps-kos', function () {
    $title = 'Peta Sebaran Kos';
    return view('pages.maps', ['title' => $title]);
});
Route::get('/search-kos', [KosController::class, 'search'])->name('search-kos');
Auth::routes(['verify' => true]);
Auth::routes();
Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth:web', 'role:Admin,Pemilik_kos', 'verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //akun managemen
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
Route::middleware(['auth:web', 'role:User', 'verified'])->group(function () {
    Route::get('/akun', function () {
        $title = 'Akun Saya';
        return view('pages.akun', ['title' => $title]);
    });
});

Route::middleware(['auth:web', 'role:User', 'verified'])->group(function () {
    Route::get('/kos-saya',  [SewaController::class, 'kos_user'])->name('kos-saya');
    Route::get('/sewa/ajukan',  [SewaController::class, 'ajukan'])->name('sewa.ajukan');
    Route::post('/sewa/store',  [SewaController::class, 'store'])->name('sewa.store');
    Route::post('/rating/store',  [RatingController::class, 'store'])->name('rating.store');
});
Route::middleware(['auth:web', 'role:Pemilik_kos', 'verified'])->group(function () {
    //sewa managemen
    Route::get('/sewa',  [SewaController::class, 'index'])->name('sewa');
    Route::get('/sewa/accept/{id}', [SewaController::class, 'accept'])->name('sewa.accept');
    Route::get('/sewa/reject/{id}', [SewaController::class, 'reject'])->name('sewa.reject');
    // Route::get('/sewa-datatable',  [SewaController::class, 'getSewaDataTable']);

    //kos managemen
    Route::get('/my-kos',  [KosController::class, 'kos'])->name('my-kos');
    Route::post('/kos/store',  [KosController::class, 'store'])->name('kos.store');
    Route::post('/kos/update-fasilitas-umum',  [KosController::class, 'update_fasilitas_umum'])->name('kos.update-fasilitas-umum');
    Route::put('/kos/update/{id}',  [KosController::class, 'update'])->name('kos.update');
    Route::get('/kos/edit-fasilitas-umum/{id}',  [KosController::class, 'edit_fasilitas_umum'])->name('kos.edit-fasilitas-umum');
    Route::post('/kos/store-fasilitas-tambahan',  [KosController::class, 'storeFasilitasTambahan'])->name('kos.store-fasilitas-tambahan');
    Route::delete('/kos/destroy-fasilitas-tambahan/{id}',  [KosController::class, 'destroyFasilitasTambahan'])->name('kos.destroy-fasilitas-tambahan');
    Route::get('/fasilitas-umum-datatable/{id_kos}', [KosController::class, 'getFasilitasUmumDataTable']);
    Route::get('/fasilitas-tambahan-datatable/{id_kos}', [KosController::class, 'getFasilitasTambahanDataTable']);
});
Route::middleware(['auth:web', 'role:Admin,Pemilik_kos', 'verified'])->group(function () {
    //rating management
    Route::get('/rating', [RatingController::class, 'index'])->name('rating');
    Route::get('/rating-datatable', [RatingController::class, 'getRatingDataTable']);
    //sewa management
    Route::get('/sewa/detail/{id}', [SewaController::class, 'detail'])->name('sewa.detail');
    Route::get('/sewa-datatable', [SewaController::class, 'getSewaDataTable']);
});
Route::middleware(['auth:web', 'role:Admin', 'verified'])->group(function () {
    //kos managemen
    Route::get('/kos', [KosController::class, 'index'])->name('kos');
    Route::delete('/kos/delete/{id}',  [KosController::class, 'destroy'])->name('kos.delete');
    //lokasi managemen
    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi');
    Route::post('/lokasi/store_kelurahan',  [LokasiController::class, 'store_kelurahan'])->name('lokasi.store_kelurahan');
    Route::post('/lokasi/store_jalan',  [LokasiController::class, 'store_jalan'])->name('lokasi.store_jalan');
    Route::get('/lokasi/edit_jalan/{id}',  [LokasiController::class, 'edit_jalan'])->name('lokasi.edit_jalan');
    Route::get('/lokasi/edit_kelurahan/{id}',  [LokasiController::class, 'edit_kelurahan'])->name('lokasi.edit_kelurahan');
    Route::delete('/lokasi/delete_kelurahan/{id}',  [LokasiController::class, 'destroy_kelurahan'])->name('lokasi.delete_kelurahan');
    Route::delete('/lokasi/delete_jalan/{id}',  [LokasiController::class, 'destroy_jalan'])->name('lokasi.delete_jalan');
    Route::get('/kelurahan-datatable', [LokasiController::class, 'getKelurahanDataTable']);
    Route::get('/jalan-datatable', [LokasiController::class, 'getJalanDataTable']);
    //fasilitas managemen
    Route::get('/fasilitas', [FasilitasKosController::class, 'index'])->name('fasilitas');
    Route::post('/fasilitas/store',  [FasilitasKosController::class, 'store'])->name('fasilitas.store');
    Route::get('/fasilitas/edit/{id}',  [FasilitasKosController::class, 'edit'])->name('fasilitas.edit');
    Route::delete('/fasilitas/delete/{id}',  [FasilitasKosController::class, 'destroy'])->name('fasilitas.delete');
    Route::get('/fasilitas-datatable', [FasilitasKosController::class, 'getFasilitasDataTable']);
    //user managemen
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/user', [UserController::class, 'user'])->name('users.user');
    Route::get('/users/owner', [UserController::class, 'owner'])->name('users.owner');
    Route::post('/users/store',  [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}',  [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/delete/{id}',  [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users-datatable/{role}', [UserController::class, 'getUsersDataTable']);
});
