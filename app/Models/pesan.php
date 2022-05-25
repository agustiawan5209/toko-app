<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    protected $table = "pesans";
    protected $primary_key = "id";
    protected $fillable = ['kode_pesan','kode_transaksi', 'detail_pesanan_id', 'supplier_id', 'status', 'tgl_pemesanan'];
    use HasFactory;
    public function detail_pesanan(){
        return $this->belongsTo(DetailPesanan::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
