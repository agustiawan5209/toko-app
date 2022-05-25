<?php

use App\Http\Livewire\Laporan\DBB;
use App\Http\Livewire\Laporan\DTP;
use App\Http\Livewire\Laporan\DPAM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Items\EditModal;
use App\Http\Livewire\Pesan\Pemesanan;
use App\Http\Livewire\Master\PageStock;
use App\Http\Livewire\Master\PageProduk;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProdukController;
use App\Http\Livewire\Gudang\BahanBakuExp;
use App\Http\Livewire\Items\PageBahanBaku;
use App\Http\Livewire\Master\PageCustomer;
use App\Http\Livewire\Master\PageSupplier;
use App\Http\Livewire\User\DetailLivewire;
use App\Http\Livewire\Items\PagePesanBarang;
use App\Http\Livewire\Laporan\DPAMPenjualan;
use App\Http\Livewire\Transaksi\BarangMasuk;
use App\Http\Livewire\Transaksi\BarangKeluar;

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

Route::get('/', [IndexController::class, 'index'])->name('Home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::name('Admin')->group(function () {
//     Route::get('HAUDH/CV/Pesan-Barang', PagePesanBarang::class)->name('Pesan-Barang-admin');
// });
Route::get('HAUDH/CV/Produk', PageProduk::class)->name('produk');
Route::get('HAUDH/CV/Customer', PageCustomer::class)->name('customer');
Route::get('HAUDH/CV/Supplier', PageSupplier::class)->name('supplier');

// Detail
Route::get('HAUDH/Detail/{table}/{nameRoute}/{linkID}', DetailLivewire::class)->name("Detail");
// Transaksi

// Halaman Utama Toko

// Halaman Pemsanan Barang user
Route::get('HAUDH/CV/Pemesanan', Pemesanan::class)->name('pemesanan');

// Hallaman Edit Barang
Route::get('HAUDH/Edit/{table}/{nameRoute}/{linkID}', EditModal::class)->name('EditItem');

// Stock
// Route Gudang
// Route::name('Gudang')->group(function () {
//     Route::get('HAUDH/Gudang/HAUDH/Bahan-baku-jadi', BahanBakuExp::class)->name('Bahan-baku-jadi');
// });

//Route

// Bahan Baku
// if(Auth::user()->jenis == "Users"){
// Route::name('user')->group(function () {
//     Route::get('HAUDH/bahan-baku', PageBahanBaku::class)->name('Bahan-baku');
//     Route::get('HAUDH/Produk', [ProdukController::class, 'index'])->name('TokoProduk');
//     Route::get('HAUDH/Stock', [StockController::class, 'index'])->name('TokoStock');
//     Route::get('HAUDH/Tentang-Kami', function () {
//         return view('Toko.About');
//     })->name('About');
// });
// Route::name('Laporan')->group(function () {
//     Route::get('HAUDH/Laporan/Data-Produksi', DPAM::class)->name('Data-Produksi');
//     Route::get('HAUDH/Laporan/Data-Bahan-Baku', DBB::class)->name('Data-BB');
//     Route::get('HAUDH/Laporan/Data-Transaksi-Pemesananan', DTP::class)->name('Data-pemesanan');
//     Route::get('HAUDH/Laporan/Data-Produksi-Penjualan', DPAMPenjualan::class)->name('Data-penjualan');
// });
// }
//
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' =>  'role:Supplier', 'prefix' => 'Supplier', 'as' => 'Supplier.'], function () {
        // Route::get('HAUDH/bahan-baku', PageBahanBaku::class)->name('Bahan-baku');
        Route::get('HAUDH/Produk', [ProdukController::class, 'index'])->name('TokoProduk');
        Route::get('HAUDH/Stock', [StockController::class, 'index'])->name('TokoStock');
        Route::get('HAUDH/Tentang-Kami', function () {
            return view('Toko.About');
        })->name('About');
    });
    Route::group(['middleware' =>  'role:Admin', 'prefix' => 'Admin', 'as' => 'Admin.'], function () {
        // Laporan Penjualan Dan Pembelian
        Route::get('HAUDH/Laporan/Data-Produksi', DPAM::class)->name('Data-Produksi');
        Route::get('HAUDH/Laporan/Data-Bahan-Baku', DBB::class)->name('Data-BB');
        Route::get('HAUDH/Laporan/Data-Transaksi-Pemesananan', DTP::class)->name('Data-pemesanan');
        Route::get('HAUDH/Laporan/Data-Produksi-Penjualan', DPAMPenjualan::class)->name('Data-penjualan');
        // Input Barang Masuk Dan Keluar
        Route::get('HAUDH/CV/Barang-Masuk', BarangMasuk::class)->name('Barang-Masuk');
        Route::get('HAUDH/CV/Barang-Keluar', BarangKeluar::class)->name('Barang-Keluar');

        // Pemesanan Barang
        Route::get('HAUDH/CV/Pesan-Barang', PagePesanBarang::class)->name('Pesan-Barang-admin');
        // Stock Barang
        Route::get('HAUDH/CV/Stock', PageStock::class)->name('PageStock');
    });
    Route::group(['middleware' =>  'role:Gudang', 'prefix' => 'Gudang', 'as' => 'Gudang.'], function () {
        Route::get('HAUDH/Gudang/HAUDH/Bahan-baku-jadi', BahanBakuExp::class)->name('Bahan-baku-jadi');

        Route::get('HAUDH/CV/Barang-Masuk', BarangMasuk::class)->name('Barang-Masuk');
        Route::get('HAUDH/CV/Barang-Keluar', BarangKeluar::class)->name('Barang-Keluar');
    });
});
Route::get('HAUDH/CV/Stock', PageStock::class)->name('PageStock');
