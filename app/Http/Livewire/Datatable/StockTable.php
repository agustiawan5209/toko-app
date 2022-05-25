<?php

namespace App\Http\Livewire\Datatable;

use App\Models\Stock;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

// Halaman Tampilan Stock Bahan Baku
class StockTable extends LivewireDatatable
{
    public $model = Stock::class;

    public function columns()
    {
        return  [
            NumberColumn::name('id')->label('ID')->defaultSort('asc')->sortBy('id'),
            NumberColumn::name('default_stock.bahan_baku')->label('Bahan Baku')->searchable(),
            NumberColumn::name('jumlah_stock')->label('Stock Yang Tersedia')->editable(),
            Column::name('satuan')->label('Satuan'),
            DateColumn::name('tgl_stock')->label('Tanggal Update'),
        ];
    }
}
