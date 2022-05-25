<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produk;
use App\Models\Stock;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ProdukTable extends LivewireDatatable
{
    // public $model = Produk::class;

    public function builder()
    {
        return Produk::query();
    }
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('id'),

            Column::name('kode_stock_produk')
                ->label('Kode Produk')
                ->defaultSort('asc')
                ->sortBy('kode_stock_produk')
                ->searchable(),
            DateColumn::name('tgl_stock_produk')
                ->label('Tanggal Produk'),
                Column::name('jumlah_stock_produk')->label('Jumlah Stock'),
            Column::callback(['id', 'kode_stock_produk'], function ($id, $link) {
                return view('livewire.items.table-action', ['id' => $id, 'link' => $link, 'tabel' => 'Produk']);
            })->unsortable()->label('Aksi'),
        ];
    }
    public function getstock(){
        return Stock::all();
    }
    public function stock()
    {
        return Produk::with('Stock')->get();
    }
}
