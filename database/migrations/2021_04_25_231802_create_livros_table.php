<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('codigo')->required;
            $table->string('titulo', 255)->required;
            $table->string('autor', 255)->required;
            $table->string('editora', 255)->required;
            $table->integer('edicao')->required;
            $table->integer('volume')->default(1);
            $table->integer('numero_de_paginas')->nullable;
            $table->integer('numero_de_emprestimos')->default(0);
            $table->integer('numero_de_exemplares')->default(0);
            $table->string('descricao', 2000)->nullable;
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
        Schema::dropIfExists('livros');
    }
}
