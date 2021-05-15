<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableExemplaresRename extends Migration
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
            $table->renameColumn('id_livro', 'codigo_livro');
        });
    }

    /**
     * Reverse the migrations.
     *s
     * @return void
     */
    public function down()
    {
        //
        Schema::table('exemplares', function (Blueprint $table) {
            $table->renameColumn('codigo_livro', 'id_livro');
        });
    }
}
