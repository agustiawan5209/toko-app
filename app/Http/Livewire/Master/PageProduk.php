<?php

namespace App\Http\Livewire\Master;

use App\Models\pesan;
use App\Models\Produk;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;

class PageProduk extends Component
{
    public $addItem;
    public $userSaved;
    public  $kodeProduk, $tgl_Produk, $jmlh_produk;
    public $autoKode = "";
    public function mount()
    {
        $this->addItem = false;
        $this->userSaved = false;
    }
    public function addingItem()
    {
        //@dd($this->addItem);
        $this->addItem = true;
        $this->userSaved = false;
    }
    public function closeFlash()
    {
        $this->userSaved = false;
    }
    // public function Saved()
    // {
    //     $this->addItem=false;
    //     $this->userSaved = true;
    // }
    public function autoCode()
    {
        $query = Produk::max('kode_stock_produk');
        if (empty($query)) {
            $this->kodeProduk = "KSP1";
        } else {
            $exp =  explode("P", $query);
            $str = 'KSP';
            $this->kodeProduk = sprintf("%s%u", $str, abs($exp[1] + 1));
        }
        return $this->kodeProduk;
    }
    public function Saved()
    {
        $date = date('Y-m-d H:i:s');

        $this->validate([
            'kodeProduk' => 'required',
            'tgl_Produk' => 'required',
            'jmlh_produk' => 'required',
        ]);
        $this->tgl_Produk = date('Y-m-d');
        $data = [
            'kode_stock_produk' => $this->kodeProduk,
            'tgl_stock_produk' => $this->tgl_Produk,
            'jumlah_stock_produk' => $this->jmlh_produk,
            'created_at' => $date
        ];
        Produk::insert($data);
        session()->flash("Pesan", $this->kodeProduk ? "Berhasil Ditambah" : "Gagal Ditambah");
        $this->userSaved = true;
        $this->addItem = false;
    }


    public function render()
    {
        $produk = Produk::all();
        return view('livewire.master.page-produk', [
            'produk' => $produk,
        ]);
    }
}
