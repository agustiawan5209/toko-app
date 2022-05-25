<?php

namespace App\Http\Livewire\Datatable\Laporan;

use App\Models\Produk;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class DPAM extends LivewireDatatable
{
    public function builder()
    {
        return Produk::query();
    }

    public function columns()
    {
        return [
            Column::name('kode_stock_produk')->label('Kode Produk Harian'),
            DateColumn::name('tgl_stock_produk')->label('Tanggal Produk Harian')->filterable(),
            NumberColumn::name('jumlah_stock_produk:count')->label('Jumlah Produk Harian'),
        ];
    }
}
