<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cola_productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lote_id');
            $table->integer('producto_id');
            $table->timestamp('fechaRegistro');
            $table->text('hash_cadena');
            $table->string('uid');
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
        Schema::dropIfExists('cola_productos');
    }
}
