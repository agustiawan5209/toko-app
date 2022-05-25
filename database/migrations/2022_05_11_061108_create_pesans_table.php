<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * transaksi Keluar
     */
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesan')->unique();
            $table->date('tgl_pemesanan');
            $table->foreignId('detail_pesanan_id');
            $table->foreignId('supplier_id');
            $table->enum('status', ['Selesai', 'Belum Selesai', 'Dalam Proses']);
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
        Schema::dropIfExists('pesans');
    }
}
