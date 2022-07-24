<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('travel_id')->constrained('travel')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('review_id')->constrained('review')->onDelete('restrict')->nullable();
            $table->foreignId('tour_guide_id')->constrained('users')->onDelete('restrict')->nullable();
            $table->string('kode_transaksi');
            $table->integer('jumlah_peserta');
            $table->integer('total_harga');
            $table->string('status', 100);
            $table->string('link_pembayaran')->nullable();
            $table->string('bukti_pekerjaan')->nullable();

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
        Schema::dropIfExists('transaksi');
    }
}
