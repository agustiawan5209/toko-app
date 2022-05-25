<?php

namespace App\Http\Livewire\Datatable\Laporan;

use App\Models\bahan_baku;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class DBB extends LivewireDatatable
{
    public function builder()
    {
        return bahan_baku::query();
    }

    public function columns()
    {
        return [
            Column::callback(['gambar'], function ($media) {
                return view('livewire.items.tampimg', ['media' => $media]);
            })->label(__('Gambar')),
            Column::name('default_stock.bahan_baku')->label('Bahan Baku')->searchable(),
            NumberColumn::name('harga')->label('Harga Bahan Baku')->format(),
            DateColumn::name('created_at')->label('Tanggal Transaksi'),
            Column::name('supplier.supplier')->label('Supplier'),
        ];
    }
}
