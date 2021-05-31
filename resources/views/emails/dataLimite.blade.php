<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css">
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
        <h2>Olá, {{ $emprestimos[0]->nome }}</h2>

        <p>O empréstimo dos exemplares realizado no dia <strong>{{ $emprestimos[0]->data_emprestimo }}</strong> está chegando ao fim.</p>
        <p>Evite bloqueios e multas. Renove ou realize a devolução dos exemplares antes do fim do prazo.</p>
        <p>Fim do prazo: <strong>{{ $emprestimos[0]->data_limite }}</strong>.</p>

        <table>
            <thead>
                <tr>
                    <th scope="col">Data Empréstimo</th>
                    <th scope="col">Data Limite</th>
                    <th scope="col">Exemplar</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Editora</th>
                    <th scope="col">Edição</th>
                    <th scope="col">Volume</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emprestimos as $emprestimo)
                    <tr>                            
                        <td>
                            {{$emprestimo->data_emprestimo}}
                        </td>
                        <td>
                            {{$emprestimo->data_limite}}
                        </td>
                        <td>
                            {{$emprestimo->codigo}}
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>