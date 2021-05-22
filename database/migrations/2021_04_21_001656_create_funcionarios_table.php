<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {

            $table->id();
            $table->string('nome',255)->require;
            $table->string('email',255)->require;
            $table->integer('matricula')->unique()->require;
            $table->unsignedBigInteger('id_usuario');
            $table->string('telefone',25)->require;
            $table->integer('cargo')->default;
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('usuarios');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $table->dropForeign('funcionarios_id_usuario_foreign');
        
        Schema::dropIfExists('funcionarios');
    
    }
}
