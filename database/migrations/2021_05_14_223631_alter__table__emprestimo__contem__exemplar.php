<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableEmprestimoContemExemplar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('emprestimo_contem_exemplar', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->date('data_devolucao');
            $table->boolean('status');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('emprestimo_contem_exemplar', function (Blueprint $table) {
            $table->timestamps();
            $table->dropColumn('data_devolucao');
            $table->dropColumn('status');
            
        });
    }
}
