<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    protected $primary_key = 'id';
    protected $fillable = ['kode_stock_produk', 'tgl_stock_roduk','jumlah_stock_produk'];
    use HasFactory;

    public function Stock()
    {
        return $this->hasOne(Stock::class);
    }
}
