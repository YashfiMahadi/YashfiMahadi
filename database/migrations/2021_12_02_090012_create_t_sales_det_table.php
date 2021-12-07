<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSalesDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_sales_det', function (Blueprint $table) {
            $table->id('sales_id');
            $table->foreignId('barang_id');
            $table->decimal('harga_bandrol');
            $table->integer('qyt');
            $table->decimal('diskon_pct');
            $table->decimal('diskon_nilai');
            $table->decimal('harga_diskon');
            $table->decimal('total');
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
        Schema::dropIfExists('t_sales_det');
    }
}
