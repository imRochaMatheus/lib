<?php

use App\Exemplar;
use Illuminate\Database\Seeder;

class ExemplarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exemplar = new Exemplar();
        $exemplar->codigo = 41111;
        $exemplar->id_livro = 1;
        $exemplar->status = 1;
        $exemplar->save();

        $exemplar = new Exemplar();
        $exemplar->codigo = 41221;
        $exemplar->id_livro = 2;
        $exemplar->status = 1;
        $exemplar->save();

        $exemplar = new Exemplar();
        $exemplar->codigo = 41331;
        $exemplar->id_livro = 3;
        $exemplar->status = 1;
        $exemplar->save();

        $exemplar = new Exemplar();
        $exemplar->codigo = 41441;
        $exemplar->id_livro = 4;
        $exemplar->status = 1;
        $exemplar->save();
    }
}
