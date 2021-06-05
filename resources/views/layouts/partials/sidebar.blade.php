<nav id="sidebar" class="sidebar-wrapper">
    <input type="checkbox" id="open-sidebar" hidden>
    <div class="sidebar-content">
        <div class="sidebar-brand">
            @if(isset($acesso) && $acesso != 3)
                <a href="{{ route('auth.on.dashboard') }}">
                    <span>BIBLI<i class="fas fa-power-off"></i>N</span>
                </a>
            @else
                <a href="{{ route('auth.estudante.painel') }}">
                    <span>BIBLI<i class="fas fa-power-off"></i>N</span>
                </a>
            @endif
        </div>
        <div class="sidebar-header">
            <div class="user-icon">
                <a href="{{ route('auth.on.usuario.editar') }}">
                    <img src="{{ asset($foto) }}">
                    <div class="thumb-editar">
                        <i class="fas fa-camera"></i>
                    </div>
                </a>
            </div>
            <div class="user-info">
                @if(isset($nome) && isset($sobrenome))
                    <span class="user-name">{{$nome}} <strong>{{$sobrenome}}</strong></span>
                @endif
                @isset($cargo)
                    <span class="user-role">{{$cargo}}</span>
                @endisset
            </div>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>Geral</span>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fas fa-book"></i>
                        <span>Livros</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            @if ($acesso != 3 )
                                 <li>
                                    <a href="{{ route('auth.on.emprestimo.consultar') }}">Empréstimo</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('auth.on.emprestimo.consultar') }}">Meus Empréstimos</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('auth.on.livro.consultar') }}">Livro</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @if(isset($acesso) && $acesso != 3)
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fas fa-print"></i>
                            <span>Relatórios</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('auth.on.relatorio.gerar', ['tipo' => 'emprestimo']) }}">Empréstimo</a>
                                </li>
                                <li>
                                    <a href="{{ route('auth.on.relatorio.gerar', ['tipo' => 'livro']) }}">Livro</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if(isset($acesso) && $acesso != 3)
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fas fa-users"></i>
                            <span>Usuários</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                @if(isset($acesso) && $acesso == 1)
                                    <li>
                                        <a href="{{ route('auth.on.cadastro') }}">Cadastrar</a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{ route('auth.on.funcionario.consultar') }}">Conceder Permissão</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('auth.on.estudante.consultar') }}">Buscar Estudantes</a>
                                </li>    
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>