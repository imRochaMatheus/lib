
<!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>Relatório de Empréstimos</title>

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
                    <h2 class="h2 titulo">Relatório de Empréstimos</h2>
                </div>
            </div>
            <div class="row table-responsive">
                <table class="col-md-12 table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Data Empréstimo</th>
                            <th scope="col">Data Limite</th>
                            <th scope="col">Estudante</th>
                            <th scope="col">Funcionário</th>
                            <th scope="col">Exemplar</th>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Editora</th>
                            <th scope="col">Edição</th>
                            <th scope="col">Volume</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($emprestimos) && count($emprestimos) > 0)
                            @foreach ($emprestimos as $emprestimo)
                                <tr>                            
                                    <td>
                                        {{$emprestimo->data_emprestimo}}
                                    </td>
                                    <td>
                                        {{$emprestimo->data_limite}}
                                    </td>
                                    <td>
                                        {{$emprestimo->estudante_nome}} <br>
                                        <strong class="matricula">{{$emprestimo->estudante_matricula}}</strong>
                                    </td>
                                    <td>
                                        {{$emprestimo->funcionario_nome}}<br>
                                        <strong class="matricula">{{$emprestimo->funcionario_matricula}}</strong>
                                    </td>
                                    <td>
                                        {{$emprestimo->codigo_exemplar}}
                                    </td>
                                    <td>
                                        {{$emprestimo->titulo}}
                                    </td>
                                    <td>
                                        {{$emprestimo->autor}}
                                    </td>
                                    <td>
                                        {{$emprestimo->editora}}
                                    </td>
                                    <td>
                                        {{$emprestimo->edicao}}ª
                                    </td>
                                    <td>
                                        {{$emprestimo->volume}}
                                    </td>
                                    <td>
                                        {{$emprestimo->status ? 'Devolvido' : 'Pendente'}}
                                    </td> 
                                 
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12">Nenhum registro encontrado</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>