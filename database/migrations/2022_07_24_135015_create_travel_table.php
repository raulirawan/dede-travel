<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paket_travel_id')->constrained('paket_travel')->onDelete('restrict');
            $table->integer('kuota');
            $table->integer('harga');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->string('waktu');
            $table->text('deskripsi')->nullable();

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
        Schema::dropIfExists('travel');
    }
}
