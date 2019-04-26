<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_produk')->unique();
            $table->string('nama');
            $table->integer('satuan');
            $table->integer('harga_beli')->default(null);
            $table->integer('harga_jual');
            $table->integer('stok')->default(null);
            $table->timestamps();
            $table->foreign('satuan')->references('id')->on('satuans')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
