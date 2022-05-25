<?php

namespace App\Http\Livewire\Pesan;

use App\Models\pesan;
use App\Models\Stock;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class PesanTabel extends LivewireDatatable
{
    public $confirmingUserChange = false;
    public $userDeleted = false;
    public function OpenModal()
    {
        $this->confirmingUserChange = true;
    }
    public function ChangeNot($id)
    {
        $pesan = pesan::find($id);
        $pesan->update(['status'=> 'Belum Selesai']);
        $this->userDeleted = true;
        $this->confirmingUserChange = false;
    }
    public function ChangeYes($id)
    {
        $pesan = pesan::find($id);
        $pesan->update(['status'=> 'Selesai']);

        $stock = Stock::find(1);
        $
        $this->userDeleted = true;
        $this->confirmingUserChange = false;
    }

    public function builder()
    {
        return pesan::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('ID')->defaultSort('desc')->sortBy('id'),
            Column::name('kode_pesan')->label('Kode Pesan')->searchable(),
            Column::name('detail_pesanan.produk')->label('Produk Bahan Baku')->searchable(),
            NumberColumn::name('detail_pesanan.jumlah')->label('Jumlah Produk Yang Di Pesan')->searchable(),
            NumberColumn::name('detail_pesanan.sub_total')->label('Harga (Rp)')->searchable()->format(),
            DateColumn::name('tgl_pemesanan')->label('Tanggal Pemesanan Stock')->filterable(),
            Column::name('supplier.supplier')->label('Pemasok'),
            Column::callback(['id', 'kode_pesan'], function ($id, $link) {
                return view('livewire.items.table-action', ['id' => $id, 'link' => $link, 'tabel' => 'Pemesanan']);
            })->unsortable()->label('Aksi'),

        ];
    }
}
