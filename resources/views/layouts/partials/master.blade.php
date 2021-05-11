<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        @stack('styles')
        <!-- Css -->
        <link rel="stylesheet" href="{{ asset('css/global.css')}} ">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/content.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- Nunito -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

        <title>BibliON - Gerenciamento de Livros</title>
    </head>
    <body>
        <div class="wrapper">
            @if(2 == 2)
                @include('layouts.partials.sidebar')
            @endif
            <div class="main">
                @if(2 == 2)
                    <nav id="navbar" class="navbar">
                        <button class="btn sidebar-toggle-button">
                            <i class="fas fa-bars"></i>
                        </button>
                    </nav>
                @endif
                <main class="content">
                    <div class="container-fluid p-0">
                        @yield('conteudo')
                    </div>
                </main>
                <footer class="footer">
                    <span>© 2021</span>
                    <span><strong>Biblion</strong></span>
                </footer>
            </div>
        </div>
        

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- jQuery Mask Plugin -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>

        @stack('scripts')
        <script type="text/javascript">
            $(function() {
                if(1 == 2) {
                    $('.main').css({
                        'margin': 0,
                        'background-color': 'var(--blue)'
                    });

                    $('.footer').css({
                        'position': 'fixed',
                        'bottom': '0'
                    });
                }

                $(".sidebar-dropdown > a").click(function() {
                    if ($(this).parent().hasClass('active')) {
                        $(this).next().slideUp(200);
                        $(this).parent().removeClass('active');
                    } else {
                        $(this).next().slideDown(200);
                        $(this).parent().addClass('active');
                    }
                });

                $('.sidebar-toggle-button').click(function(e) {
                    e.stopPropagation();
                    $('.sidebar-wrapper').animate({
                        width: '14em'
                    });
                    $('#open-sidebar').prop('checked', true);
                });

                /*$('body, html').click(function(e) {
                    e.stopPropagation();
                    console.log(e.target)
                    console.log($("#sidebar"))
                    console.log(e.target === $("#sidebar"))
                    if($("#open-sidebar").is(':checked')) {
                        $('.sidebar-wrapper').animate({
                            width: 0
                        });
                        $("#open-sidebar").prop('checked', false);
                    }
                });*/
            });
        </script>
    </body>
</html>