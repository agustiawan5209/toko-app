<?php

namespace App\Models;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class bahan_baku extends Model
{
    protected $table = 'bahan_bakus';
    protected $fillable = ['gambar','default_stock_id','isi', 'harga', 'suppliers_id'];
    use HasFactory;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'suppliers_id');
    }
    public function getStock(){
        return $this->hasOne(Stock::class);
    }
    public function default_stock(){
        return $this->belongsTo(DefaultBB::class, 'default_stock_id');
    }
    public function detail_stock_bahan(){
        return $this->hasOne(Detail_stock_bahan::class, 'bahan_baku_id');
    }
}
