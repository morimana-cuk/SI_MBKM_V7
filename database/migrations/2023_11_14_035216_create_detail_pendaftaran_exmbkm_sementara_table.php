<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPendaftaranExmbkmSementaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pendaftaran_exmbkm_sementara', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exmbkm_id')->references('id')->on('pendaftaran_exmbkm_sementara')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('mbkm_id')->references('id')->on('mbkms')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['pengajuan', 'diterima', 'diambil']);
            $table->string('file_diterima');
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
        Schema::dropIfExists('detail_pendaftaran_exmbkm_sementara');
    }
}