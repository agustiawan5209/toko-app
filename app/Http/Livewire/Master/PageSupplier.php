<?php

namespace App\Http\Livewire\Master;

use App\Models\Supplier;
use Livewire\Component;

class PageSupplier extends Component
{
    public $addItem;
    public $userSaved;
    public  $supplier, $no_telpon;
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
    public function Saved()
    {
        $date = date('Y-m-d H:i:s');

        $this->validate([
            'supplier' => 'required',
            'no_telpon' => 'required',
        ]);
        $no = "62";
        $im = ltrim($this->no_telpon, '0');
        $data = [
            'supplier' => $this->supplier,
            'no_telpon' => $no . $im,
            'created_at' => $date
        ];
        Supplier::insert($data);

        session()->flash("Pesan", $this->supplier ? "Berhasil Ditambah" : "Gagal Ditambah");
        $this->userSaved = true;
        $this->addItem = false;
    }

    public function render()
    {
        $supplier = Supplier::all();
        return view('livewire.master.page-supplier',[
            'row'=>$supplier
        ]);
    }
}
