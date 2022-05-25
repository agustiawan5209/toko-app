<?php

namespace App\Models;

use App\Models\detail_barang_keluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluars';
    protected $fillable =['kode_barang_keluar', 'alamat_tujuan', 'customer', 'tgl_keluar','produk_id', 'transaksi_id'];
    use HasFactory;

    public function detail_barang_keluar()
    {
        return $this->hasOne(detail_barang_keluar::class);
    }
    public function customer(){
        return $this->belongsTo(customer::class ,'customer');
    }
    public function produk(){
        return $this->belongsTo(Produk::class);
    }
    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }

}
