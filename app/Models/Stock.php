<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $primary_key = 'id';
    protected $fillable = ['bahan_baku_id', 'jumlah_stock','satuan', 'tgl_stock'];
    use HasFactory;

    public function Produk()
    {
        return $this->hasOne(Produk::class);
    }
    public function default_stock(){
        return $this->belongsTo(DefaultBB::class);
    }
}
