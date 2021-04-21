<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExemplarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exemplares', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_livro');
            $table->boolean('status')->require;
            $table->string('observacao')->nullable;
            $table->timestamps();

            $table->foreign('id_livro')->references('id')->on('livros');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        $table->dropForeign('exemplares_id_livro_foreign');
        
        Schema::dropIfExists('exemplars');
    
    }
}
