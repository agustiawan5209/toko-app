<?php

namespace App\Http\Livewire\Datatable;

use App\Models\bahan_baku;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BahanbakuTable extends LivewireDatatable
{
    // Halaman Tampilan Bahan Baku Supplier
    public function builder()
    {
        return bahan_baku::where('suppliers_id', Auth::user()->supplier->id);
    }

    public function columns()
    {
        return [
            Column::callback(['gambar'], function ($media) {
                return view('livewire.items.tampimg', ['media' => $media]);
            })->label(__('Gambar')),
            Column::name('default_stock.bahan_baku')->label('Bahan Baku')->searchable(),
            NumberColumn::name('harga')->label('Harga Bahan Baku')->format(),
            Column::callback(['id', 'default_stock.bahan_baku'], function ($id, $link) {
                return view('livewire.items.table-action', ['id' => $id, 'link' => $link, 'tabel' => 'bahan-baku']);
            })->unsortable()->label('Aksi'),
        ];
    }
}
