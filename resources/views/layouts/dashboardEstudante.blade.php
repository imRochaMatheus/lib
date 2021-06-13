@extends('layouts.partials.master')
@section('conteudo')
    <div class="col-md-12">
        <section id="blocks" class="mb-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card welcome-block">
                        <div class="card-body">
                            <div class="card-content">
                                <div class="card-content-info">
                                    <h5 class="card-title"><strong>Bem-vindo(a), {{$nome}}!</strong></h5>
                                    <p class="card-text">Aqui você pode consultar e renovar seus empréstimos, além de consultar os livros disponíveis na biblioteca.</p>
                                </div>
                                <div class="card-content-img">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">
                    <a href="{{ route('auth.on.livro.consultar') }}" class="block-link">
                        <div class="card block">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="card-content-info">
                                        <h5 class="card-title"><strong>Consultar Livro</strong></h5>
                                        <p class="card-text">Venha conhecer todo o nosso acervo bibliográfico.</p>
                                    </div>
                                    <div class="card-content-img">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('auth.on.emprestimo.consultar') }}" class="block-link">
                        <div class="card block">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="card-content-info">
                                        <h5 class="card-title"><strong>Consultar Empréstimos</strong></h5>
                                        <p class="card-text">Fique por dentro dos prazos de devolução e evite multas.</p>
                                    </div>
                                    <div class="card-content-img">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('auth.on.emprestimo.consultar') }}" class="block-link">
                        <div class="card block">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="card-content-info">
                                        <h5 class="card-title"><strong>Renovar</strong></h5>
                                        <p class="card-text">Não deu tempo de estudar tudo? Que tal passar mais um tempinho com ele?</p>
                                    </div>
                                    <div class="card-content-img">
                                        <i class="fas fa-exchange-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        @if(isset($comentarios) && count($comentarios) > 0)
            <section id="comentarios">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div id="carrosel-comentarios" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @for ($i = 0; $i < count($comentarios); $i++)
                                    @if ($i == 0)
                                        <li data-target="#carrosel-comentarios" data-slide-to="{{$i}}" class="active"></li>
                                    @else
                                        <li data-target="#carrosel-comentarios" data-slide-to="{{$i}}"></li>
                                    @endif
                                @endfor
                            </ol>
                            <div class="carousel-inner">
                                {{$flag = false}}
                                @foreach($comentarios as $coment)
                                    @if(!$flag)
                                        <?php 
                                            $flag = true;
                                        ?>
                                        <div class="carousel-item active">
                                            <div class="carousel-item-content">
                                                <div class="carousel-image">
                                                    <img class="d-block" src="{{ asset($coment->foto)}}" alt="First slide">
                                                </div>
                                                <div class="carousel-comment">
                                                    <blockquote>
                                                        <p class="mb-0">{{ $coment->comentario }}</p>
                                                        <footer class="blockquote-footer">{{$coment->nome_estudante}}</footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <div class="carousel-item-content">
                                                <div class="carousel-image">
                                                    <img class="d-block" src="{{ asset($coment->foto)}}" alt="First slide">
                                                </div>
                                                <div class="carousel-comment">
                                                    <blockquote>
                                                        <p class="mb-0">{{ $coment->comentario }}</p>
                                                        <footer class="blockquote-footer">{{$coment->nome_estudante}}</footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div>
                                    @endif            
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carrosel-comentarios" role="button" data-slide="prev">
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carrosel-comentarios" role="button" data-slide="next">
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @else
            
        @endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush