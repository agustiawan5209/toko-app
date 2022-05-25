<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Produk;
use Livewire\Component;
use App\Models\BarangKeluar as ModelsBarangKeluar;
use App\Models\Transaksi;

class BarangKeluar extends Component
{
    public $addItem = false;
    public $KBK, $userSaved = false;
    public $produk;
    public $alamat, $tgl, $kode_produk, $customer, $kode_transaksi, $harga_produk = 12800;
    public $jumlah, $sub_total, $transaksi_id;
    public function mount()
    {
        $this->customer = '';
    }
    public function resetModal()
    {
        $this->KBK = '';
        $this->alamat = '';
        $this->tgl = '';
        $this->kode_produk = '';
    }

    public function OpenModal()
    {
        $this->addItem = true;
    }
    public function CloseModal()
    {
        $this->resetModal();
        $this->addItem = false;
        $this->userSaved = false;
    }
    public function render()
    {
        $this->produk = Produk::all();
        return view('livewire.transaksi.barang-keluar');
    }
    public function generateKode()
    {
        $query = ModelsBarangKeluar::max('kode_barang_keluar');
        if (empty($query)) {
            $this->KBK = 'KBK1';
        } else {
            $exp =  explode("K", $query);
            $str = 'KBK';
            $this->KBK = sprintf("%s%u", $str, abs($exp[1] + 1));
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
            'KBK' => 'required|unique:barang_keluars,kode_barang_keluar',
            'alamat' => 'required',
            'tgl' => 'required|date',
            'kode_produk' => 'required',
        ]);

        $transaksi = [
            'kode_transaksi' => $this->transaksiKode(),
            'tgl_transaksi' => $this->tgl,
            'jenis'=> 2
        ];
        // Insert Data
        $cek =   Transaksi::create($transaksi);
        if ($cek) {
            $tr = Transaksi::latest()->first();
            $tr->id;
            $arr = [
                'kode_barang_keluar' => $this->KBK,
                'alamat_tujuan' => $this->alamat,
                'customer' => $this->customer,
                'tgl_keluar' => $this->tgl,
                'produk_id' => $this->kode_produk,
                'transaksi_id' => $tr->id,
                'jumlah' => $this->jumlah,
                'sub_total' => intval($this->jumlah) * intval($this->harga_produk),
            ];
            $barangkeluar = ModelsBarangKeluar::insert($arr);
        }
        session()->flash('message', $this->KBK ? "Berhasil Di Tambahkan " . $this->KBK : 'Gagal Ditambah');
        $this->userSaved = true;
        $this->addItem = false;
    }
    public function getTotal()
    {
        $this->sub_total = "Rp. " . number_format(intval($this->jumlah) * intval($this->harga_produk));
    }
}
