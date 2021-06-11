<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css">
            table tbody td,
            table thead th {
                text-align: center;
                vertical-align: middle;
            },

            table thead th {
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

        @foreach ($emprestimos as $emprestimo)
            <p>
                <strong>Data Empréstimo</strong>: {{ $emprestimo->data_emprestimo }}<br>
                <strong>Data Limite</strong>: {{ $emprestimo->data_limite }}<br>
                <strong>Exemplar</strong>: {{ $emprestimo->codigo }}<br>
                <strong>Título</strong>: {{ $emprestimo->titulo }}<br>
                <strong>Autor</strong>: {{ $emprestimo->autor }}<br>
                <strong>Editora</strong>: {{ $emprestimo->editora }}<br>
                <strong>Edição</strong>: {{ $emprestimo->edicao }}ª<br>
                <strong>Volume</strong>: {{ $emprestimo->volume }}
            </p>
        @endforeach

        <p>Este é um e-mail automático. Por favor, não responda. Em caso de dúvidas, entre em contato com a administração</p>
    </body>
</html>