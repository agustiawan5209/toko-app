<?php

namespace App\Http\Livewire\Master;

use App\Models\BarangMasuk;
use App\Models\Persediaan;
use App\Models\pesan;
use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Stock;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $day;
    public $model = 'produks';
    public $stock_hari_ini, $stock_habis, $stock_tersedia, $hitung_stock, $persediaan_stock;
    public $cek_habis =  false;
    public $cekModal = false;
    private function day($hari)
    {
        switch ($hari) {
            case 'sunday' || 'Sunday':
                $this->day = 'Minggu';
                break;

            case 'Monday' || 'monday':
                $this->day = 'Senin';
                break;

            case 'tuesday' || 'Tuesday':
                $this->day = 'Selasa';
                break;

            case 'Wednesday' || 'wednesday':
                $this->day = 'Rabu';
                break;

            case 'Thursday' || 'thursday':
                $this->day = 'Kamis';
                break;

            case 'Friday' || 'friday':
                $this->day = 'Jumat';
                break;

            case 'Saturday' || 'saturday':
                $this->day = 'Sabtu';
                break;
        }
        return $this->day;
    }

    public function render()
    {
        $carbon = Carbon::now();
        $stock_produk = Produk::where('tgl_stock_produk', $carbon->format('Y-m-d'))->get();
        foreach ($stock_produk as $sp) {
            $this->stock_hari_ini =  $sp->jumlah_stock_produk;
        }
        $carbon = Carbon::now();
        $bulan_ini = Produk::whereMonth('tgl_stock_produk', '=', $carbon->format('m'))
            ->whereYear('tgl_stock_produk', '=', $carbon->format('Y'))
            ->get();

        // Tampilkan stock Bahan Baku
        $stock = Stock::all();
        // Pesan
        $pesan = BarangMasuk::where('status', 'Belum Selesai')->count();
        $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // Cek Persediaan Barang
        $persediaan = Persediaan::all();
        $this->hitung_stock = $persediaan->count();
        $stock = Stock::all();
        $arrP = $persediaan->toArray();
        $arrS = $stock->toArray();
        for ($i = 0; $i <  $stock->count(); $i++) {
            if ($arrP[$i]['default_stock'] > $arrS[$i]['jumlah_stock']) {
                // $this->stock_habis = 'Stock Habis';
                $this->cek_habis = true;
            } else {
                $this->stock_tersedia = 'Tersedia';
            }
        }
        // Jika Ada Stock Produk Yang Kurang Dari 20;
        if ($this->cek_habis = true) {
            $this->stock_habis = Stock::where('jumlah_stock', '<', 20)->get();
            $this->cekModal = true;
        }
        // end
        return view('livewire.master.dashboard', [
            'stock_produk' => $stock_produk,
            'bulan_ini' => $bulan_ini->count(),
            'label' => $label,
            'pesan' => $pesan,
            'stock' => $stock,
        ]);
    }
    public function closeid()
    {
        $this->cekModal = false;
    }
}
