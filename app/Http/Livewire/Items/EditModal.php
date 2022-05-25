<?php

namespace App\Http\Livewire\Items;

use App\Models\Stock;
use App\Models\Produk;
use Livewire\Component;
use App\Models\customer;
use App\Models\Supplier;
use App\Models\DefaultBB;
use App\Models\bahan_baku;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EditModal extends Component
{
    use WithFileUploads;
    public $linkID, $nameRoute, $table, $data, $flash;
    public $item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9, $item10, $ItemTable;
    public $sub_total, $harga, $jumlah;
    public $sup, $bb, $supplier, $bahan, $hargaB;
    public $photo;
    public function mount($nameRoute, $linkID, $table)
    {
        $this->nameRoute = $nameRoute;
        $this->linkID = $linkID;
        $this->table = $table;
        $this->flash = false;
        $this->item1 = '';
        $this->sub_total = 0;
        $this->harga = 12800;
        $this->jumlah = 0;
    }
    public function getTotal()
    {
        switch ($this->table) {
            case 'Barang-Masuk':
                $custom = BarangMasuk::find($this->linkID);
                $this->jumlah =  $custom->jumlah_pembelian;
                break;
            case 'Barang-Keluar':
                $custom = BarangKeluar::find($this->linkID);
                $this->jumlah =  $custom->jumlah;
                break;
        }
        return $this->sub_total = intval($this->jumlah) * intval($this->harga);
        dd($this->sub_total);
    }
    public function getALL()
    {
        $arr = [];
        switch ($this->table) {
            case 'Customer':
                $custom = customer::find($this->linkID);
                $this->item1 = $custom->nama_customer;
                $this->item2 = $custom->no_telpon;
                $this->item3 = $custom->alamat;
                break;
            case 'Produk':
                $custom = Produk::find($this->linkID);
                $this->item1  = $custom->kode_stock_produk;
                $this->item2 =  $custom->tgl_stock_produk;
                $this->item3 =  $custom->jumlah_stock_produk;
                break;
            case 'Supplier':
                $custom = Supplier::find($this->linkID);
                $this->item1  = $custom->supplier;
                $this->item2 =  $custom->no_telpon;
                break;
            case 'Stock':
                $custom = Stock::find($this->linkID);
                $this->item1  = $custom->jumlah_stock;
                $this->item2 =  $custom->satuan;
                break;
            case 'Barang-Masuk':
                $custom = BarangMasuk::find($this->linkID);
                $this->item1  = $custom->kode_barang_masuk;
                $this->item2  = $custom->default_stock->bahan_baku;
                $this->item4  = $custom->default_stock->id;
                $this->item3  = $custom->supplier->supplier;
                $this->jumlah =  $custom->jumlah_pembelian;
                $this->sub_total =  $custom->sub_total;
                $this->item7 =  $custom->tgl_masuk;
                $BBharga = bahan_baku::where('default_stock_id', $custom->bahan)->get();
                foreach ($BBharga as $value) {
                    // $BBharga->harga;
                    $this->harga = $value->harga;
                }
                break;
            case 'Barang-Keluar':
                $custom = BarangKeluar::find($this->linkID);
                $this->item1  = $custom->kode_barang_keluar;
                $this->item2  = $custom->produk->kode_stock_produk;
                $this->item3  = $custom->alamat_tujuan;
                $this->item4 =  $custom->customer;
                $this->item5 =  $custom->transaksi->tgl_transaksi;
                $this->jumlah =  $custom->jumlah;
                $this->sub_total =  $custom->sub_total;
                break;
            case 'bahan-baku':
                $custom = bahan_baku::find($this->linkID);
                $this->photo  = $custom->gambar;
                $this->item10 = $custom->id;
                $this->item2  = $custom->default_stock->bahan_baku;
                $this->item3  = $custom->isi;
                $this->item4 =  $custom->harga;
                break;
        }
        return $arr;
    }
    public function edit($id)
    {
        switch ($this->table) {
            case 'bahan-baku':

                $validate = $this->validate([
                    'item2' => 'required',
                    'item3' => 'required',
                    'item4' => 'required',
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $validatedData = Validator::make(

                    ['photo' => $this->photo],

                    ['photo' => 'required|image'],

                    ['required' => 'The :attribute field is required'],
                    ['image'=> 'Gambar TIdak dapat di save']

                )->validate();
                dd($this->photo);
                $name = md5($this->photo . microtime()) . '.' . $this->photo->extension();
                // dd($name);
                $bahb = bahan_baku::where('id', $id)->update([
                    'gambar'  => $this->photo,
                    'default_stock_id'  => $this->item10,
                    'isi'  => $this->item3,
                    'harga'  => $this->item4,
                ]);
                if ($bahb) {
                    $this->gambar->storeAS('upload', $name);
                }

                break;
            case 'Produk':
                $this->validate([
                    'item1' => 'required',
                    'item2' => 'required|date',
                    'item3' => 'required',
                ]);
                Produk::where('id', $id)
                    ->update([
                        'kode_stock_produk' => $this->item1,
                        'tgl_stock_produk' => $this->item2,
                        'jumlah_stock_produk' => $this->item3,
                    ]);
                break;
            case 'Customer':
                $this->validate([
                    'item1' => 'required',
                    'item2' => 'required',
                    'item3' => 'required',
                ]);
                customer::where('id', $id)
                    ->update([
                        'nama_customer' => $this->item1,
                        'no_telpon' => $this->item2,
                        'alamat' => $this->item3,
                    ]);
                break;
            case 'Supplier':
                $this->validate([
                    'item1' => 'required',
                    'item2' => 'required',
                    'item3' => 'required',
                ]);
                Supplier::where('id', $id)
                    ->update([
                        'supplier' => $this->item1,
                        'no_telpon' => $this->item2,
                        // 'harga_bahan'=> $this->item3,
                        // 'no_telpon'=> $this->item4,
                    ]);
                break;
            case 'Barang-Keluar':
                $validate =  $this->validate([
                    'item3' => 'required',
                    'item4' => 'required',
                    'item5' => 'required',
                ]);
                // dd($validate);
                BarangKeluar::where('id', $id)
                    ->update([
                        'alamat_tujuan' => $this->item3,
                        'customer' => $this->item4,
                        'tgl_keluar' => $this->item5,
                        'jumlah' => $this->jumlah,
                        'sub_total' => $this->jumlah * $this->harga,
                    ]);
                break;
            case 'Barang-Masuk':
                // dd($validate);
                BarangMasuk::where('id', $id)
                    ->update([
                        'bahan' => $this->bahan,
                        'supplier_id' => $this->supplier,
                        'jumlah_pembelian' => $this->jumlah,
                        'sub_total' => intval($this->harga) * intval($this->jumlah),
                        'tgl_masuk' => $this->item7,
                    ]);
                break;
            default:
                # code...
                break;
        }
        session()->flash('message', $this->table ? 'Berhasil Di Update' : 'Gagal Di Update');
        $this->flash = true;
        return redirect()->to('Supplier/HAUDH/' . $this->table);
    }
    public function render()
    {
        // abort_if(403,Auth::user()->role_id == 2);
        $this->getALL();
        $this->sup = Supplier::all();
        $this->bb = DefaultBB::all();
        return view('livewire.items.edit-modal');
    }

    public function closeFlash()
    {
        $this->flash = false;
    }
    public function getSupplier()
    {
        $this->bb = Supplier::where('supplier', $this->supplier)->get();
    }
    public function getBahan()
    {
        $df = bahan_baku::where('suppliers_id', $this->supplier)->get();
        $this->getBB = $df;
    }
    public function getData()
    {
        $harga = bahan_baku::where('default_stock_id', $this->bahan)->get();
        foreach ($harga as $hargas) {
            $this->hargaB = $hargas->harga;
        }
    }
}
