<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegMbkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_mbkms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('mbkm_id')->nullable();
            $table->foreign('mbkm_id')->references('id')->on('mbkms')->onDelete('cascade');
            $table->enum('status', ['accepted', 'rejected', 'pending', 'menunggu_acc', 'done'])->default('pending');
            $table->unsignedBigInteger('pembimbing')->nullable();
            $table->string('requirements_files')->nullable();
            $table->string('partner_grade')->nullable();
            $table->foreign('pembimbing')->references('id')->on('lecturers')->onDelete('cascade');
            $table->text('keterangan_kaprodi')->nullable();
            $table->enum('acc_nilai', ['Approved', 'Not Approved'])->nullable()->default(null);
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
        Schema::dropIfExists('reg_mbkms');
    }
}
