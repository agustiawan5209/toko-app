<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    protected $table = 'persediaans';
    protected $fillable = ['bahan_baku', 'default_stock'];
    use HasFactory;

    public function default_stock(){
        return $this->belongsTo(DefaultBB::class, 'bahan_baku');
    }
}
