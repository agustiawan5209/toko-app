<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BarangMasukTable extends LivewireDatatable
{
    public $model = BarangMasuk::class;
    public $hideable = 'select';
    // public $exportable = true;
    // public $complex = true;
    public $persistComplexQuery = true;
    public $afterTableSlot = 'components.selected';
    public function builder()
    {
        return BarangMasuk::query()->join('suppliers', 'suppliers.id', 'barang_masuks.supplier_id');
    }
    // public $model = BarangMasuk::class;
    public function columns()
    {
        return [
            Column::checkbox(),
            NumberColumn::name('id')->label('ID')->defaultSort('asc')->sortBy('id'),
            Column::name('kode_barang_masuk')->label('Kode Barang')->searchable(),
            Column::name('default_stock.bahan_baku')->label('Bahan')->searchable()->sortby('Bahan'),
            Column::name('supplier.supplier')->label('Supplier'),
            Column::name('jumlah_pembelian')->label('Jumlah Pembelian Stock'),
            DateColumn::name('tgl_masuk')->label('Tanggal Pembelian')->format('j F Y')
            ->sortBy(DB::raw('DATE_FORMAT(barang_masuks.tgl_keluar, "%m%d%Y")')),
            NumberColumn::name('sub_total')->label('Biaya')->format(),
            Column::callback(['id', 'status' ,'kode_barang_masuk'], function ($id, $status, $kode) {
                return view('livewire.items.CheckboxTable', ['id' => $id, 'status' => $status, 'kode'=> $kode]);
            })->unsortable()->label('Status Pemesanan'),
            Column::name('status')->label('Status'),
            Column::callback(['id', 'kode_barang_masuk'], function ($id, $link) {
                return view('livewire.items.table-action', ['id' => $id, 'link' => $link, 'tabel' => 'Barang-Masuk']);
            })->unsortable()->label('Aksi'),
        ];
    }
    public $confirmingUserChange = false;
    public $userDeleted = false;
    public function OpenModal()
    {
        $this->confirmingUserChange = true;
    }
    public function ChangeNot($id)
    {
        BarangMasuk::where('id',$id)->update(['status'=> 'Belum Selesai']);
        $this->userDeleted = true;
        $this->confirmingUserChange = false;
    }
    public function ChangeYes($id)
    {
        BarangMasuk::where('id',$id)->update(['status'=> 'Selesai']);
        $bM = BarangMasuk::find($id);
        if($bM){
        $stock = Stock::select('jumlah_stock')
        ->where('default_stock_id', $bM->bahan)
            ->get();
        foreach ($stock as $a) {
            $hasil = intval($a->jumlah_stock) + intval($bM->jumlah_pembelian);
        }
        // dd($hasil);
        Stock::where('default_stock_id', $bM->bahan)
            ->update(['jumlah_stock' => $hasil]);

        }

        $this->userDeleted = true;
        $this->confirmingUserChange = false;
    }
}
