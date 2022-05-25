<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class AutoKode extends Controller
{
    public function autokode()
    {
        $query = BarangMasuk::max('kode_barang_masuk');
        if (empty($query->count())) {
            $KBM = 'KBM1';
        } else {
            $exp =  explode("M", $query);
            $str = 'KBM';
            $KBM = sprintf("%s%u", $str, abs($exp[1] + 1));
            $tgl_Produk = date('Y-m-d');;
            return $KBM;
        }
    }
}
