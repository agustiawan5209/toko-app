<?php

namespace App\Http\Livewire\Datatable;

use App\Models\BarangKeluar;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class BarangKeluarTable extends LivewireDatatable
{
    // Halaman Tampilan Barang Keluar
    public function builder()
    {
        return BarangKeluar::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('ID')->defaultSort('asc')->sortBy('id'),
            Column::name('kode_barang_keluar')->label('Kode Barang Keluar')->searchable(),
            Column::name('alamat_tujuan')->label('Tujuan')->searchable(),
            Column::name('Customer')->label('Customer'),
            DateColumn::name('tgl_keluar')->label('Tanggal Barang Keluar'),
            Column::name('produk.kode_stock_produk')->label('kode_barang'),
            NumberColumn::name('jumlah')->label('Jumlah'),
            NumberColumn::name('Sub_total')->label('Sub Total')->format(2),
            Column::callback(['id', 'kode_barang_keluar'], function ($id, $link) {
                return view('livewire.items.table-action', ['id' => $id, 'link' => $link, 'tabel' => 'Barang-Keluar']);
            })->unsortable()->label('Aksi'),
        ];
    }
}
