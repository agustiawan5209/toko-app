<?php

namespace App\Http\Livewire\Datatable\Laporan;

use App\Models\pesan;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DTPemesanan extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;
    // public $complex = true;
    // public $persistComplexQuery = true;
    // public $afterTableSlot = 'components.selected';
    public function builder()
    {
        return pesan::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('ID')->defaultSort('asc')->sortBy('id'),
            Column::name('kode_pesan')->label('Kode Pesan')->searchable(),
            Column::name('detail_pesanan.produk')->label('Produk Bahan Baku'),
            NumberColumn::name('detail_pesanan.jumlah')->label('Jumlah Produk Yang Di Pesan'),
            NumberColumn::name('detail_pesanan.sub_total')->label('Harga (Rp)')->searchable()->format()->filterable(),
            DateColumn::name('tgl_pemesanan')->label('Tanggal Pemesanan Stock')->filterable(),
            Column::name('status')->label('Status Pemesanan')->filterable(),
        ];
    }
}
