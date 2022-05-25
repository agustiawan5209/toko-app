<?php

namespace App\Http\Livewire\Datatable\Laporan;

use App\Models\BarangKeluar;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class DPAPenjualan extends LivewireDatatable
{
    public function builder()
    {
        return BarangKeluar::query();
    }

    public function columns()
    {
        return [
            Column::name('kode_barang_keluar')->label('Kode Barang Keluar'),
            Column::name('produk.kode_stock_produk')->label('Produk Barang Keluar'),
            Column::name('transaksi.kode_transaksi')->label('Kode Transaksi'),
            Column::name('alamat_tujuan')->label('Alamat/Tujuan'),
            Column::name('customer')->label('Customer'),
            DateColumn::name('transaksi.tgl_transaksi')->label('Tanggal Transaksi')->filterable(),
            NumberColumn::name('jumlah')->label('Jumlah Barang Keluar'),
            NumberColumn::name('sub_total')->label('Total')->format(),
        ];
    }
}
