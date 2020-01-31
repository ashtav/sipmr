<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->date('tgl_lahir');
            $table->string('tmp_lahir');
            $table->enum('jk',['laki-laki','perempuan'])->default('laki-laki');
            $table->enum('agama',['buddha','hindu','islam','katolik','konghucu','kristen','none'])->nullable();
            $table->string('foto')->nullable();
            $table->string('telp');
            $table->string('alamat');
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
        Schema::dropIfExists('user_details');
    }
}
