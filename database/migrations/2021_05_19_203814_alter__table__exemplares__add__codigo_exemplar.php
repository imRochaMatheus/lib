<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableExemplaresAddCodigoExemplar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('exemplares', function (Blueprint $table) {
            $table->integer('codigo_exemplar')->after('id_livro');
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
        Schema::table('exemplares', function (Blueprint $table) {
            $table->dropColumn('codigo_exemplar');
        });
    }
}
