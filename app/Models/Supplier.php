<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primary_key = 'id';
    protected $fillable = ['supplier', 'no_telpon'];
    use HasFactory;

    public function bahan_baku(){
        return $this->hasOne(bahan_baku::class, 'suppliers_id');
    }
    public function barang()
    {
        return $this->hasOne(BarangMasuk::class, 'supplier_id');
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
