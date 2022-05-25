<?php

namespace App\Http\Livewire\Items;

use Carbon\Carbon;
use App\Models\pesan;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\bahan_baku;
use App\Models\BarangMasuk;
use Illuminate\Support\Arr;
use App\Models\DetailPesanan;

class PagePesanBarang extends Component
{
    public $modal = false;
    public $kirim, $itemTab, $BB, $Additem, $kode_transaksi;
    public $supplier, $sup_id, $no_telpon, $bahan, $harga, $keterangan, $jumlah, $tgl, $sub_total, $bahan_id, $KBM;
    public $kodepesan, $IDtabOpen, $countTab;
    public function TabID($id)
    {
        $bahan_sp = bahan_baku::where('suppliers_id', $id)->get();
        $arr = [];
        for ($i = 0; $i < $bahan_sp->count(); $i++) {
            $arr[] = $bahan_sp[$i]['id'];
        }
        $this->IDtabOpen = true;
        $this->itemTab = $bahan_sp;
        // dd($bahan_sp);
    }
    public function modalOpen()
    {
        $this->modal = true;
    }
    public function render()
    {
        $this->BB = bahan_baku::all();
        $supplier = Supplier::all();
        return view('livewire.items.page-pesan-barang', [
            'tbSupplier' => $supplier,
        ]);
    }
    public function pesanKode()
    {
        $query = pesan::max('kode_pesan');
        if (empty($query)) {
            $this->kodepesan = 'KP01';
        } else {
            $exp =  explode("P", $query);
            $str = 'KP';
            $this->kodepesan = sprintf("%s0%u", $str, intval($exp[1] + 1));
        }
        return $this->kodepesan;
    }
    public function Pesan($id)
    {
        $data = bahan_baku::find($id);
        $supplier = Supplier::where('id', $id)->get();
        $this->sup_id = $data->supplier->id;
        $this->supplier = $data->supplier->supplier;
        $this->no_telpon = $data->supplier->User->phone;
        $this->bahan = $data->default_stock->bahan_baku;
        $this->bahan_id = $data->default_stock->id;

        // cek harga
        $this->harga = $data->harga;
        $this->jumlah = '1';
        $this->tgl = Carbon::now()->format('Y-m-d');
        $this->sub_total = "Rp. " . number_format(intval($this->harga) * intval($this->jumlah), 0, 2);
        $this->Additem = true;
        // return redirect()->to("https://wa.me/" . $data->supplier->no_telpon . "?text=" . $pesan);

    }
    public function closeModal()
    {
        $this->Additem = false;
        $this->modal = false;
    }
    public function getSubTotal()
    {
        $this->sub_total = "Rp. " . number_format(intval($this->harga) * intval($this->jumlah), 0, 2);
    }
    public function transaksiKode()
    {
        $query = Transaksi::max('kode_transaksi');
        if (empty($query)) {
            $this->kode_transaksi = 'KT1';
        }  else {
            $exp =  explode("T", $query);
            $str = 'KT';
            // $this->kode_transaksi = substr($query,2);
           $this->kode_transaksi= sprintf("%s0%u", $str, abs($exp[1] + 1));
        }
        // dd([$this->kode_transaksi, $query++]);
        return $this->kode_transaksi;
    }
    public function kirim()
    {
        $this->validate([
            'keterangan' => 'required',
        ]);
        $detail = [
            'produk' => $this->bahan,
            'jumlah' => intval($this->jumlah),
            'sub_total' => intval($this->harga) * intval($this->jumlah),
            'keterangan' => $this->keterangan,
        ];
        $det = DetailPesanan::create($detail);
        if ($det) {
            $dpi = DetailPesanan::latest()->first();
            $insert = [
                'kode_pesan' => $this->pesanKode(),
                'tgl_pemesanan' => $this->tgl,
                'detail_pesanan_id' => $dpi->id,
                'supplier_id' => $this->sup_id,
                'status' => 'Belum Selesai'
            ];
            pesan::create($insert);
            $this->BarangMasuk();
        }
        $txt = explode(" ", $this->keterangan);
        $str = '%20';
        $imp = implode($str, $txt);
        $text = "CV.%20THAHIRA%0AKami%20Ingin%20Melakukan%20Pesanan%0ABahan%20Baku%20" . $this->bahan . "%0AJumlah%20Pesanan%20%3D%20" . $this->jumlah . "%0AMohon%20Dikonfirmasi%0AKeterangan%20%3D%20%0A" . $imp . "%0A";
        $this->Additem = false;
        return redirect()->to("https://wa.me/" . $this->no_telpon . "?text=" . $text);
    }
    public function KodeBarangMasuk()
    {
        $query = BarangMasuk::max('kode_barang_masuk');
        if (empty($query)) {
            $this->KBM = 'KBM01';
        } else {
            $exp =  explode("M", $query);
            $str = 'KBM';
            $this->KBM = sprintf("%s0%u", $str, abs($exp[1] + 1));
        }
        return $this->KBM;
    }
    public function BarangMasuk()
    {

        $transaksi = [
            'kode_transaksi' => $this->transaksiKode(),
            'tgl_transaksi' => $this->tgl,
            'jenis' => 1
        ];
        // Insert Data
        $cek =   Transaksi::create($transaksi);
        if ($cek) {
            $tr = Transaksi::latest()->first();
            $tr->id;
            $data = [
                'kode_barang_masuk' => $this->KodeBarangMasuk(),
                'bahan' => $this->bahan_id,
                'supplier_id' => $this->sup_id,
                'jumlah_pembelian' => intval($this->jumlah),
                'sub_total' => intval($this->harga) * intval($this->jumlah),
                'tgl_masuk' => $this->tgl,
                'transaksi_id' => $tr->id,
                'status'=> 'Belum Selesai'
            ];
            BarangMasuk::create($data);
        }
        session()->flash("message", $this->KBM ? "Berhasil Ditambah Menambah " . $this->KBM : "Gagal Ditambah");
        $this->userSaved = true;
        $this->addItem = false;
        // // Update Stock
        // $stock = Stock::select('jumlah_stock')
        // ->where('default_stock_id', $this->bahan)
        //     ->get();
        // foreach ($stock as $a) {
        //     $hasil = intval($a->jumlah_stock) + intval($this->jumlah);
        // }
        // // dd($hasil);
        // Stock::where('default_stock_id', $this->bahan)
        //     ->update(['jumlah_stock' => $hasil]);
    }
}
