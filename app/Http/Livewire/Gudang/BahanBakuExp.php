<?php

namespace App\Http\Livewire\Gudang;

use App\Models\DefaultBB;
use App\Models\Stock;
use App\Models\Produk;
use Livewire\Component;
use Carbon\Carbon;

class BahanBakuExp extends Component
{
    public $stock_bahan_tersedia;
    public $produk_jadi, $kodeproduk;
    public $dus, $pipet, $cup, $penutup, $lakban;
    public $stockdus, $stockpipet, $stockcup, $sctockpenutup, $stocklakban;
    public $itemAlert = false;
    public $DUS_dus;
    public $DUS_pipet;
    public $DUS_cup;
    public $DUS_penutup;
    public $DUS_lakban;
    protected $messages = [
        'required' => 'Mohon Untuk Di Isi.',
    ];
    public function render()
    {
        $this->stock_bahan_tersedia = Stock::all();
        return view('livewire.gudang.bahan-baku-exp');
    }

    public function getDus()
    {
        $getJmlStock = Stock::find(1);
        if (!empty($getJmlStock)) {
            $hasil =  intval($getJmlStock->jumlah_stock - $this->dus);
            Stock::where('id', $getJmlStock->id)
                ->where('jumlah_stock', '>', 5)
                ->update(['jumlah_stock' => $hasil]);
        }
    }
    public function Proses()
    {
        $carbon = Carbon::now()->format('Y-m-d');
        // dd([$carbon, $this->produk_jadi]);
        $stock = Stock::where('jumlah_stock', '<', 10)->get();
        if ($stock->count() < 1) {
            $df = DefaultBB::all();
            $i = 0;
            $arr = [];
            for ($i; $i < $df->count(); $i++) {
                $arr[] = $df[$i]['bbs'];
            }
            // dd($arr);
            // menentukan Default value Atas Persediaan Barang;

            $this->dus = $arr[0] * $this->produk_jadi;
            $this->pipet = $arr[1] * $this->produk_jadi;
            $this->cup = $arr[2] * $this->produk_jadi;
            $this->penutup = $arr[3] * $this->produk_jadi;
            $this->lakban = $arr[4] * $this->produk_jadi;
            // menentukan default Mkasimal
            if ($this->dus >= 24) {
                $this->DUS_dus = floor($this->dus / 24);
            }
            if ($this->pipet >= 50) {
                $this->DUS_pipet = floor($this->pipet / 50);
            }
            if ($this->cup >= 3350) {
                $this->DUS_cup = floor($this->cup / 3350);
            }
            if ($this->penutup >= 232) {
                $this->DUS_penutup = floor($this->penutup / 232);
            }
            if ($this->lakban >= 72) {
                $this->DUS_lakban = floor($this->lakban / 72);
            }
        } else {
            session()->flash('message', "Maaf Jumlah Stock Yang Dibutuhkan Tidak Tersedia");
        }
    }
    public function autoCode()
    {
        $query = Produk::max('kode_stock_produk');
        $query = Produk::max('kode_stock_produk');
        if (empty($query)) {
            $this->kodeProduk = "KSP1";
        } else {
            $exp =  explode("P", $query);
            $str = 'KSP';
            $this->kodeProduk = sprintf("%s%u", $str, abs($exp[1] + 1));
        }
        return $this->kodeproduk;
    }
    public function Update()
    {
        $this->validate([
            'dus' => 'required|integer',
            'pipet' => 'required|integer|',
            'cup' => 'required|integer',
            'penutup' => 'required|integer',
            'lakban' => 'required|integer',
            'produk_jadi' => 'required|integer',
        ]);
        if ($this->produk_jadi > 24) {
        }

        $carbon = Carbon::now()->format("Y-m-d");
        $fun = Stock::all();
        $arr = [
            $this->stockdus = $this->DUS_dus,
            $this->stockpipet = $this->DUS_pipet,
            $this->stockcup = $this->DUS_cup,
            $this->stockpenutup = $this->DUS_penutup,
            $this->stocklakban = $this->DUS_lakban,
        ];
        // dd($arr);
        for ($i = 0; $i < $fun->count(); $i++) {
            if (intval($fun[$i]['jumlah_stock']) > 4) {
                $hasil = intval($fun[$i]['jumlah_stock']) - intval($arr[$i]);
                Stock::where('id', $fun[$i]['id'])->update(['jumlah_stock' => $hasil]);
            } else {
                $stock_habis = Stock::where('jumlah_stock', '<', 5)->get();
                session()->flash('message', $stock_habis[$i]['default_stock_id'] ? "Stock Habis ." . $stock_habis[$i]['default_stock.bahan_baku'] : "Berhasil");
            }
        }
        $pro = Produk::where('tgl_stock_produk', $carbon)->latest()->first();
        if (empty($pro)) {
            Produk::insert([
                'kode_stock_produk' => $this->autoCode(),
                'jumlah_stock_produk' => $this->produk_jadi,
                'tgl_stock_produk' => $carbon,
            ]);
        } else {
            $plus = $pro->jumlah_stock_produk + $this->produk_jadi;
            Produk::where('tgl_stock_produk', $carbon)
                ->update(['jumlah_stock_produk' => $plus]);
        }
        session()->flash('message', 'Data Berhasil Di update');
    }
}
