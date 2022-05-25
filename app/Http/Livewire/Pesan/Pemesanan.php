<?php

namespace App\Http\Livewire\Pesan;

use Livewire\Component;

class Pemesanan extends Component
{
    public $showDropdown = false;
    public $Modal= false;
    public function OpenMOdal(){
        $this->Modal = true;
    }
    public function archive()
    {

        $this->showDropdown = false;
    }

    public function delete()
    {

        $this->showDropdown = false;
    }
    public function render()
    {
        return view('livewire.pesan.pemesanan');
    }
}
