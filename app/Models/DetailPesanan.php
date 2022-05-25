<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanans';
    protected $fillable = ['produk', 'jumlah','sub_total', 'keterangan'];
    use HasFactory;
}
