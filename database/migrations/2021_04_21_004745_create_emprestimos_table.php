<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {

            $table->id();
            $table->integer('matricula')->require;
            $table->unsignedBigInteger('id_estudante');
            $table->unsignedBigInteger('id_funcionario');
            $table->datetime('data_emprestimo');
            $table->date('data_limite');
            $table->date('data_devolucao');
            $table->double('multa');

            $table->foreign('id_estudante')->references('id')->on('estudantes');
            $table->foreign('id_funcionario')->references('id')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $table->dropForeign('emprestimos_id_estudante_foreign');
        $table->dropForeign('emprestimos_id_funcionario_foreign');
        
        Schema::dropIfExists('emprestimos');

    }
}
