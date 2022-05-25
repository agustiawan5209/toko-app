<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuks';
    protected $fillable = ['kode_barang_masuk', 'bahan', 'supplier_id', 'jumlah_pembelian', 'tgl_keluar', 'sub_total', 'tgl_masuk', 'transaksi_id'];
    use HasFactory;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function default_stock()
    {
        return $this->belongsTo(DefaultBB::class, 'bahan');
    }
    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
    public function bahan_baku(){
        return $this->belongsTo(bahan_baku::class);
    }
}
