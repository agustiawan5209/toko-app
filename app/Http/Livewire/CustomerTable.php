<?php

namespace App\Http\Livewire;

use App\Models\customer;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CustomerTable extends LivewireDatatable
{
    public $model = Customer::class;
    public $nameRoute = 'Customer';
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('id'),

            Column::name('nama_customer')
                ->label('Nama Customer')
                ->editable()
                ->searchable(),
            Column::name('no_telpon')
                ->label('No. Telpon'),
            Column::name('alamat')
                ->label('Alamat'),
            DateColumn::name('created_at')
                ->label('Tanggal DiBuat'),
            Column::callback(['id', 'nama_customer'], function ($id, $link) {
                return view('livewire.items.table-action', ['id' => $id, 'link' => $link, 'tabel'=> 'Customer']);
            })->unsortable()->label('Aksi'),

        ];
    }
}
