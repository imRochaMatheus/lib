<?php
use App\Livro;
use Illuminate\Database\Seeder;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $livro = new Livro();
        $livro->codigo = 4111;
        $livro->titulo = "Harry Potter e a Pedra filosofal";
        $livro->autor = "J. K. Rowling";
        $livro->editora = "Bloomsbury Publishing";
        $livro->edicao = 1;
        $livro->volume = 1;
        $livro->foto = "storage/books/4111.jpeg";
        $livro->descricao = "O livro conta a história de Harry Potter, um órfão criado pelos tios que descobre, em seu décimo primeiro aniversário, que é um bruxo.";
        $livro->numero_de_exemplares = 1;
        $livro->numero_de_paginas = 255;
        $livro->save();

        $livro = new Livro();
        $livro->codigo = 4122;
        $livro->titulo = "Harry Potter e a Câmara Secreta";
        $livro->autor = "J. K. Rowling";
        $livro->editora = "Bloomsbury Publishing";
        $livro->edicao = 1;
        $livro->volume = 1;
        $livro->foto = "storage/books/4122.jpeg";
        $livro->descricao = "Os Dursley estavam tão anti-sociais naquele verão, que tudo o que Harry queria era voltar às aulas da Escola de Bruxarias de Hogwarts. No entanto, quando já terminava de fazer suas malas, Harry recebe um aviso de um estranho chamado Dobby, que diz que um desastre acontecerá caso Potter decida voltar à Hogwarts. Harry não liga para aquela mensagem e o desastre realmente acontece";
        $livro->numero_de_exemplares = 1;
        $livro->numero_de_paginas = 255;
        $livro->save();

        $livro = new Livro();
        $livro->codigo = 4133;
        $livro->titulo = "As Crônicas de Nárnia";
        $livro->autor = "C. S. Lewis";
        $livro->editora = "Martins Fontes";
        $livro->edicao = 1;
        $livro->volume = 1;
        $livro->foto = "storage/books/4133.jpeg";
        $livro->descricao = "Há 67 anos, a pequena Lúcia se escondia em um guarda-roupa durante um jogo de esconde-esconde contra os irmãos. Entre jaquetas e casacos, ela acabou encontrando um novo mundo: trata-se de Nárnia, uma terra onde animais falam, um leão é a autoridade máxima e crianças humanas têm o poder de mudar a história.";
        $livro->numero_de_exemplares = 1;
        $livro->numero_de_paginas = 255;
        $livro->save();

        $livro = new Livro();
        $livro->codigo = 4144;
        $livro->titulo = "As Crônicas de Gelo e Fogo";
        $livro->autor = " George R. R. Martin";
        $livro->editora = "Suma";
        $livro->edicao = 1;
        $livro->volume = 1;
        $livro->foto = "storage/books/4144.jpeg";
        $livro->descricao = "No passado, sete reinos independentes foram tomados, um a um, e posteriormente unificados por Aegon e suas irmãs-esposas Rhaenys e Visenya — todos da Casa Targaryen. Embora os Targaryen possuíssem um exército pequeno comparado com os dos outros reinos eram a única casa nobre que possuía dragões, o que acabou por lhes dar a maior vantagem.";
        $livro->numero_de_exemplares = 1;
        $livro->numero_de_paginas = 255;
        $livro->save();
    }
}
