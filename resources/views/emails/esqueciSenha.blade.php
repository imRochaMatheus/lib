<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <style type="text/css">
            .app-name, .senha {
                font-weight: 800;
            }

            .app-name, .nova-senha {
                color: #FFD666;
            }
        </style>
    </head>

    <body>
        <p>Você está recebendo este e-mail devido a uma solicitação de redefinição de senha do seu acesso ao <span class="app-name">BibliON</span>.</p>
        <p>Caso não tenha solicitado a redefinição, entre em contato com a administração.</p>
        <p class="senha">Sua nova senha é: <span class="nova-senha">{{ $usuario->senha }}</span></p>
        <p>Este é um e-mail automático. Por favor, não responda. Em caso de dúvidas, entre em contato com a administração</p>
    </body>
</html>