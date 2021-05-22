<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprestimoContemExemplarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimo_contem_exemplar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emprestimo_id');
            $table->unsignedBigInteger('codigo_exemplar');
            $table->date('data_limite')->nullable();
            $table->date('data_devolucao')->nullable();
            $table->integer('renovacoes')->default(3);
            $table->boolean('status')->default(false);

            $table->foreign('codigo_exemplar')->references('codigo')->on('exemplares');
            $table->foreign('emprestimo_id')->references('id')->on('emprestimos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('restimo_contem_exemplar_emprestimo_id_foreign');
        $table->dropForeign('restimo_contem_exemplar_exemplar_id_foreign');
        
        Schema::dropIfExists('emprestimo_contem_exemplar');
    }
}
