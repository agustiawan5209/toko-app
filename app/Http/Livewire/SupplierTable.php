<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class SupplierTable extends LivewireDatatable
{
    public $model = Supplier::class;
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('id'),
            Column::name('supplier')
                ->label('Supplier')->searchable(),
            Column::name('User.phone')->label('Nomor Telpon')->searchable(),
            Column::name('bahan_baku.default_stock.bahan_baku')->label('Bahan')->searchable(),
            Column::callback(['id', 'supplier'], function ($id, $link) {
                return view('livewire.items.table-action', ['id' => $id, 'link' => $link, 'tabel' => 'Supplier']);
            })->unsortable()->label('Aksi'),
        ];
    }
}
