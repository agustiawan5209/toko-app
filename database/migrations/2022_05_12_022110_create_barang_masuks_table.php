<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang_masuk')->unique();
            $table->string('bahan');
            $table->string('supplier_id');
            $table->string('jumlah_pembelian');
            $table->string('sub_total');
            $table->date('tgl_masuk');
            $table->foreignId('transaksi_id');
            $table->enum('status', ['Selesai', 'Belum Selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_masuks');
    }
}
