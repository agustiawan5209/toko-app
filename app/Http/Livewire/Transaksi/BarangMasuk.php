<?php

namespace App\Http\Livewire\Transaksi;

use Carbon\Carbon;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\bahan_baku;
use App\Models\BarangMasuk as ModelsBarangMasuk;
use App\Models\DefaultBB;

class BarangMasuk extends Component
{
    public $addItem = false;
    public $sup, $bb;
    public $supplier, $harga, $jumlah, $KBM, $sub_total, $tgl, $bahan, $userSaved, $getBB;

    public function AddingItem()
    {
        $this->supplier = '';
        $this->harga = 0;
        $this->jumlah = '';
        $this->KBM = '';
        $this->sub_total = '';
        $this->tgl = Carbon::now()->format('Y-m-d');
        $this->bahan = 'Cup';
        $this->addItem = true;
        $this->userSaved = false;
    }
    public function render()
    {
        $this->sup = Supplier::all();
        $this->bb = DefaultBB::all();
        return view('livewire.transaksi.barang-masuk');
    }
    public function getData()
    {
        $harga = bahan_baku::where('default_stock_id', $this->bahan)->get();
        foreach ($harga as $hargas) {
            $this->harga = $hargas->harga;
        }
    }
    public function getSupplier()
    {
        $this->bb = Supplier::where('supplier', $this->supplier)->get();
        // foreach($this->bb as $BBS){
        //     $this->bb = $BBS->bahan_baku->bahan;
        // }
    }
    public function sub_total()
    {
        $this->sub_total = "Rp. " . number_format(intval($this->harga) * intval($this->jumlah), 0, 2);
    }
    public function generateKode()
    {
        $query = ModelsBarangMasuk::max('kode_barang_masuk');
        if (empty($query)) {
            $this->KBM = 'KBM1';
        } else {
            $exp =  explode("M", $query);
            $str = 'KBM';
            $this->KBM = sprintf("%s%u", $str, abs($exp[1] + 1));
        }
    }
    public function transaksiKode()
    {
        $query = Transaksi::max('kode_transaksi');
        if (empty($query)) {
            $this->kode_transaksi = 'KT1';
        } else {
            $exp =  explode("T", $query);
            $str = 'KT';
            $this->kode_transaksi = sprintf("%s%u", $str, abs($exp[1] + 1));
        }
        return $this->kode_transaksi;
    }
    public function submit()
    {
        $this->validate([
            'KBM' => 'required',
            'bahan' => 'required',
            'supplier' => 'required',
            'jumlah' => 'required|integer',
            'sub_total' => 'required',
            'tgl' => 'required',
        ]);
        $transaksi = [
            'kode_transaksi' => $this->transaksiKode(),
            'tgl_transaksi' => $this->tgl,
            'jenis'=> 1
        ];
        // Insert Data
        $cek =   Transaksi::create($transaksi);
        if ($cek) {
            $tr = Transaksi::latest()->first();
            $tr->id;
            $data = [
                'kode_barang_masuk' => $this->KBM,
                'bahan' => $this->bahan,
                'supplier_id' => $this->supplier,
                'jumlah_pembelian' => $this->jumlah,
                'sub_total' => intval($this->harga) * intval($this->jumlah),
                'tgl_masuk' => $this->tgl,
                'transaksi_id' => $tr->id,
            ];
            ModelsBarangMasuk::create($data);
        }
        session()->flash("message", $this->KBM ? "Berhasil Ditambah Menambah " . $this->KBM : "Gagal Ditambah");
        $this->userSaved = true;
        $this->addItem = false;
        // Update Stock
        $stock = Stock::select('jumlah_stock')
        ->where('default_stock_id', $this->bahan)
            ->get();
        foreach ($stock as $a) {
            $hasil = intval($a->jumlah_stock) + intval($this->jumlah);
        }
        // dd($hasil);
        Stock::where('default_stock_id', $this->bahan)
            ->update(['jumlah_stock' => $hasil]);
    }
    public function closeAlert()
    {
        $this->userSaved = false;
    }
    public function getBahan()
    {
        // $getbbSupplier = bahan_baku::select('default_stock_id')
        // ->where('supplier_id', $this->supplier)
        // ->leftJoin('default_stocks', 'bahan_bakus.default_stock_id', '=', 'default_stocks.bahan_baku')
        // ->get();

        // $arr = [];
        // foreach($getbbSupplier as $row){
        //     $arr[] = $row->default_stock_id;
        // }
        $df = bahan_baku::where('suppliers_id', $this->supplier)->get();
        $this->getBB = $df;
    }
}
