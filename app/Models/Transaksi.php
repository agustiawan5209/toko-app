<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable= ['kode_transaksi', 'tgl_transaksi'];
    use HasFactory;

    public function barang_keluar(){
        return $this->hasOne(BarangKeluar::class);
    }
    public function barang_masuk(){
        return $this->hasOne(BarangMasuk::class);
    }

}

