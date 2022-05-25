<?php

namespace App\Http\Livewire\Items;

use App\Models\bahan_baku;
use App\Models\DefaultBB;
use App\Models\Detail_stock_bahan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
// use Illuminate\Validation\Validator;
use Livewire\WithFileUploads;

class PageBahanBaku extends Component
{
    use WithFileUploads;
    public $modal = false;
    public $gambar, $bahan, $satuan, $harga, $isi, $pcs;
    public function openModal()
    {
        $this->modal = true;
    }
    public function render()
    {
        $bahan = DefaultBB::all();
        // abort_if( Auth::user()->jenis == "SuperAdmin", 403);
        return view('livewire.items.page-bahan-baku', [
            'def' => $bahan,
        ]);
    }
    public function submit()
    {
        $validate =  $this->validate([
            'gambar' => 'image|max:1024',
            'bahan' => 'required',
            'harga' => 'required',
            'isi' => 'required',
        ]);

        $name = md5($this->gambar . microtime()) . '.' . $this->gambar->extension();
        $arr = [
            'gambar' => $name,
            'default_stock_id' => $this->bahan,
            'isi' => $this->isi,
            'harga' => $this->harga,
            'suppliers_id' => Auth::user()->supplier->id,
        ];

        $bb = bahan_baku::create($arr);
        // dd([$arr, $defBahan]);

        if($bb){
            session()->flash('message', $this->gambar ? "Berhasil Ditambahkan" : 'Gagal Ditambahkan');
            $this->gambar->storeAS('upload', $name);
        }
        $this->modal = false;
    }
    public function closeAlert()
    {
        session()->delete();
    }
}
