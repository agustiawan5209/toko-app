<?php

namespace App\Http\Livewire\Datatable;

use App\Models\bahan_baku;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Pemesanan extends LivewireDatatable
{
    public function builder()
    {
        return bahan_baku::query();
    }

    public function columns()
    {
        return [
            Column::name('gambar')->label('Gambar'),
            Column::name('bahan')->label('Bahan Baku'),
            Column::name('satuan')->label('Satuan'),
            NumberColumn::name('harga')->label('Harga Bahan Baku')->format(),
            Column::name('kualitas')->label('Kualitas'),
            Column::name('supplier.supplier')->label('Supplier'),
            Column::callback(['id', 'bahan'], function ($id, $link) {
                return view('livewire.items.btn-keranjang', ['id' => $id, 'link' => $link, 'tabel' => 'Barang-Masuk']);
            })->unsortable()->label('Aksi'),
        ];
    }
}
