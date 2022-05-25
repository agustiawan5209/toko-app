<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stock;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public $day, $month, $year;
    public function day()
    {
        $carbon = Carbon::now()->format('l-d-m-Y');
        $pecah = explode('-',$carbon);
        switch ($pecah[0]) {
            case 'Sunday':
                $this->day = 'Minggu';
                break;

            case 'Monday' :
                $this->day = 'Senin';
                break;

            case 'Tuesday':
                $this->day = 'Selasa';
                break;

            case 'Wednesday':
                $this->day = 'Rabu';
                break;

            case 'Thursday':
                $this->day = 'Kamis';
                break;

            case 'Friday':
                $this->day = 'Jumat';
                break;

            case 'Saturday':
                $this->day = 'Sabtu';
                break;
        }
        $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $bulan = array (
            1 =>   'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
            );
        return $this->day. " " . $pecah[1] . " " . $bulan[(int) $pecah[2]] . ' '. $pecah[3];
    }
    public function index()
    {

        $stock = Stock::all();
        $carbon = Carbon::now()->format('l-d-m-Y');
        // dd($this->day());
        return view('welcome', [
            'Stock' => $stock,
            'carbon' => $this->day()
        ]);
    }
}
