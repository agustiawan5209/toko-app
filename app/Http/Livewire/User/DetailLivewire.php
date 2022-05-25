<?php

namespace App\Http\Livewire\User;

use App\Models\pesan;
use App\Models\Stock;
use App\Models\Produk;
use Livewire\Component;
use App\Models\customer;
use App\Models\Supplier;
use App\Models\bahan_baku;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DetailLivewire extends Component
{
    public  $linkID, $nameRoute, $customer, $no_telpon, $alamat, $table;
    public $item;
    public function mount()
    {
        $this->customer = "Raihan Balijan Maulana";
        $this->no_telpon = "(+62) 947 9812 7099";
        $this->alamat = "Dk. W.R. Supratman No. 685, Ambon 61441, Bali";
        $this->item = false;
    }
    public function getlinkID($nameRoute, $linkID, $table)
    {
        $this->nameRoute = $nameRoute;
        $this->linkID = $linkID;
        $this->table = $table;
    }
    public function kembali()
    {
        if (Auth::user()->jenis == "Gudang" || Auth::user()->jenis == "SuperAdmin") {
            return redirect()->to('/HAUDH/CV/' . $this->table);
        } else if (Auth::user()->jenis == "Users") {
            return redirect()->to('/HAUDH/' . $this->table);
        }
    }
    public function render()
    {
        $arr = [];
        switch ($this->table) {
            case 'Customer':
                $custom = customer::find($this->linkID);

                $arr = [
                    'Nama Customer' => $custom->nama_customer,
                    'Nomor Telpon' => $custom->no_telpon,
                    'Alamat' => $custom->alamat,
                    'Tanggal Informasi Dibuat' => date("F j, Y, g:i a", strtotime($custom->created_at)),
                ];
                break;
            case 'Produk':
                $custom = Produk::find($this->linkID);
                $arr = [
                    'Kode Produk'  => $custom->kode_stock_produk,
                    'Tanggal Produk' =>  $custom->tgl_stock_produk,
                    'Jumlah Stock Produk' =>  $custom->jumlah_stock_produk,
                    'Tanggal Informasi Dibuat' => date("F j, Y, g:i a", strtotime($custom->created_at)),
                ];
                break;
            case 'Supplier':
                $custom = Supplier::find($this->linkID);
                $arr = [
                    'Supplier'  => $custom->supplier,
                    'Produk' =>  $custom->bahan_baku->default_stock->id,
                    'Nomor Telpon' =>  "+".$custom->User->phone,
                    'Tanggal Informasi Dibuat' => date("F j, Y, g:i a", strtotime($custom->created_at)),
                ];
                break;
            case 'Stock':
                $custom = Stock::find($this->linkID);
                $arr = [
                    'Bahan'  => $custom->bahan,
                    'Jumlah Stock ' =>  $custom->stock . " " . $custom->satuan,
                    'Tanggal Informasi Dibuat' => date("F j, Y, g:i a", strtotime($custom->created_at)),
                ];
                break;
            case 'Barang-Masuk':
                $custom = BarangMasuk::find($this->linkID);
                $arr = [
                    'Kode Barang Masuk'  => $custom->kode_barang_masuk,
                    'Kode Transaksi' => $custom->transaksi->kode_transaksi,
                    'Bahan'  => $custom->default_stock->bahan_baku,
                    'Supplier'  => $custom->supplier->supplier,
                    'Jumlah pembelian'  => $custom->jumlah_pembelian,
                    'Total'  => "Rp. " . number_format($custom->sub_total, 2, ',', '.'),
                    'Tanggal Transaksi'  => date("F j, Y", strtotime($custom->transaksi->tgl_transaksi)),
                    'Tanggal Informasi Dibuat' => date("F j, Y, g:i a", strtotime($custom->created_at)),
                ];
                break;
            case 'Barang-Keluar':
                $custom = BarangKeluar::find($this->linkID);
                $arr = [
                    'Kode Barang Keluar'  => $custom->kode_barang_keluar,
                    'Produk'  => $custom->produk->kode_stock_produk,
                    'Kode Transaksi'  => $custom->transaksi->kode_transaksi,
                    'Jumlah pembelian'  => $custom->jumlah,
                    'Total'  => "Rp. " . number_format($custom->sub_total, 2, ',', '.'),
                    'Tanggal Masuk'  => date("F j, Y", strtotime($custom->tgl_keluar)),
                    'Tanggal Informasi Dibuat' => date("F j, Y, g:i a", strtotime($custom->created_at)),
                ];
                break;
            case 'Pemesanan':
                $custom = pesan::find($this->linkID);
                $arr = [
                    'Kode Barang Keluar'  => $custom->kode_pesan,
                    'Tanggal Pemesanan'  => date("F j, Y", strtotime($custom->tgl_pemesanan)),
                    'Produk'  => $custom->detail_pesanan->produk,
                    'Jumlah pembelian'  => $custom->detail_pesanan->jumlah,
                    'Total'  => "Rp. " . number_format($custom->detail_pesanan->sub_total, 2, ',', '.'),
                    'Tanggal Informasi Dibuat' => date("F j, Y, g:i a", strtotime($custom->created_at)),
                ];
                break;
            case 'bahan-baku':
                $custom = bahan_baku::find($this->linkID);
                $arr = [
                    'Image'  => $custom->gambar,
                    'Bahan Baku'  => $custom->default_stock->bahan_baku,
                    'Satuan'  => $custom->satuan,
                    'Isi'  => $custom->isi,
                    'Harga'  => "Rp. " . number_format($custom->harga, 2, ',', '.'),
                ];
                break;
            default:
                $this->customer = "Raihan Balijan Maulana";
                $this->no_telpon = "(+62) 947 9812 7099";
                $this->alamat = "Dk. W.R. Supratman No. 685, Ambon 61441, Bali";
                break;
        }
        // dd($arr);
        return view('livewire.user.detail-livewire', ['arr' => $arr]);
    }
}
