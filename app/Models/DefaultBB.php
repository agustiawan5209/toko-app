<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultBB extends Model
{
    protected $table = 'default_b_b_s';
    protected $fillable = ['id','bahan_baku', 'bbs', 'maxbb'];
    use HasFactory;

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
    public function Supplier(){
        return $this->hasOne(Supplier::class);
    }
    public function bahan_baku(){
        return $this->hasMany(bahan_baku::class, 'default_stock_id');
    }
}
