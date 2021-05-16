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
                <i class="fas fa-user-circle"></i>
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
                            @if(isset($acesso) && $acesso != 3)
                                <li>
                                    <a href="{{ route('auth.on.emprestimo.consultar') }}">Empréstimo</a>
                                </li>
                            @endisset
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
                                    <a href="#">Devolução</a>
                                </li>
                                <li>
                                    <a href="#">Empréstimo</a>
                                </li>
                                <li>
                                    <a href="#">Livro</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if(isset($acesso) && $acesso == 1)
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fas fa-users"></i>
                            <span>Usuários</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('auth.on.cadastro') }}">Cadastrar</a>
                                </li>
                                <li>
                                    <a href="{{ route('auth.on.funcionario.consultar') }}">Conceder Permissão</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>