<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoteProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lote_productos', function (Blueprint $table) {
            $table->bigIncrements('lote_id');
            $table->string('lote');
            $table->integer('producto_id');
            $table->timestamp('fechaRegistro');
            $table->dateTime('fechaVencimiento');
            $table->integer('cantidad');
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
        Schema::dropIfExists('lote_productos');
    }
}
