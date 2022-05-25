<?php

namespace App\Http\Livewire\Master;

use App\Models\customer;
use Livewire\Component;

class PageCustomer extends Component
{
    public $addItem;
    public $userSaved;
    public  $customer, $no_telpon,$alamat;
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
    public function closeFlash(){
        $this->userSaved=false;
    }
    // public function Saved()
    // {
    //     $this->addItem=false;
    //     $this->userSaved = true;
    // }

    public function Saved()
    {
        $date = date('Y-m-d H:i:s');

        $this->validate([
            'customer' => 'required',
            'no_telpon' => 'required',
            'alamat' => 'required',
        ]);
        $data = [
            'nama_customer' => $this->customer,
            'no_telpon' => $this->no_telpon,
            'alamat' => $this->alamat,
            'created_at' => $date
        ];
        customer::insert($data);

        session()->flash("Pesan", $this->customer ? "Berhasil Ditambah" : "Gagal Ditambah");
        $this->userSaved = true;
        $this->addItem = false;
    }

    public function render()
    {
        return view('livewire.master.page-customer');
    }
}
