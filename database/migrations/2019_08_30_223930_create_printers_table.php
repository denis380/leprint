<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('serial')->unique();
            $table->string('modelo')->nullable();
            $table->string('coluna')->nullable();
            $table->string('galpao')->nullable();
            $table->integer('contador')->nullable();
            $table->string('area')->nullable();
            $table->string('etiqueta')->nullable();
            $table->string('responsavel')->nullable();
            $table->string('ip')->nullable();
            $table->string('situacao')->nullable();
            
            

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
        Schema::dropIfExists('printers');
    }
}
