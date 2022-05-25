<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_stock_bahan extends Model
{
    public $table = 'detail_stock_bahans';
    public $fillable = ['bahan_baku_id', 'pcs', 'isi'];
    use HasFactory;

    // public function bahan_baku(){
    //     return $this->belongsTo(bahan_baku::class);
    // }
}
