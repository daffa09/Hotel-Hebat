<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('email');
            $table->string('nama_tamu');
            $table->string('no_tlp');
            $table->date("tgl_pesan");
            $table->date("tgl_checkin");
            $table->date("tgl_checkout");
            $table->integer('jml_kamar');
            $table->enum('status', ['Pending', 'Check In', 'Check Out', 'Batal'])->default('Pending');
            $table->foreignId("id_tipe_kamar");
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
        Schema::dropIfExists('reservasi');
    }
};
