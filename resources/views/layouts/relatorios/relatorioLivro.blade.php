<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>Relatório de Livros</title>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

            <style type="text/css">                        
                .titulo {
                    color: #FFD666;
                    text-align: center;
                }

                .matricula {
                    font-size: 0.9em;
                }

                .table tbody td,
                .table thead th {
                    text-align: center;
                    vertical-align: middle;
                },

                .table thead th {
                    color: #8D734B;
                    background-color: #FFD666;
                    border-color: #FFD666;
                    text-align: center;
                }
            </style>
        </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h2 titulo">Relatório de Livros</h2>
                </div>
            </div>
            <div class="row table-responsive">
                <table class="col-md-12 table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Código Livro</th>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Editora</th>
                            <th scope="col">Edição</th>
                            <th scope="col">Volume</th>
                            <th scope="col">N/ Exemplares</th>
                            <th scope="col">Registro</th>
                            <th scope="col">Última atualização</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($livros) && count($livros) > 0)
                            @foreach ($livros as $livro)
                                <tr>                            
                                    <td>
                                        {{$livro->codigo}}
                                    </td>
                                    <td>
                                        {{$livro->titulo}} <br>                                    
                                    </td>
                                    <td>
                                        {{$livro->autor}}<br>
                                    </td>
                                    <td>
                                        {{$livro->editora}}
                                    </td>
                                    <td>
                                        {{$livro->edicao}}ª
                                    </td>
                                    <td>
                                        {{$livro->volume}}
                                    </td>
                                    <td>
                                        {{$livro->numero_de_exemplares}}
                                    </td>
                                    <td>
                                        {{$livro->created_at}}
                                    </td>
                                    <td>
                                        {{$livro->updated_at}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">Nenhum registro encontrado</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>