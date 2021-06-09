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
        </section>
        <section id="comentarios">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div id="carrosel-comentarios" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carrosel-comentarios" data-slide-to="0" class="active"></li>
                            <li data-target="#carrosel-comentarios" data-slide-to="1"></li>
                            <li data-target="#carrosel-comentarios" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="carousel-item-content">
                                    <div class="carousel-image">
                                        <img class="d-block" src="{{ asset('images/o-nome-do-vento.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-comment">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non est sed elit malesuada semper. Sed a odio nec dui dignissim pharetra. Phasellus consectetur, neque vehicula bibendum porta, neque sapien mollis elit, nec lacinia enim libero non sem. Morbi maximus luctus velit, in varius neque.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="carousel-item-content">
                                    <div class="carousel-image">
                                        <img class="d-block" src="{{ asset('images/hp.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-comment">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non est sed elit malesuada semper. Sed a odio nec dui dignissim pharetra. Phasellus consectetur, neque vehicula bibendum porta, neque sapien mollis elit, nec lacinia enim libero non sem. Morbi maximus luctus velit, in varius neque.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="carousel-item-content">
                                    <div class="carousel-image">
                                        <img class="d-block" src="{{ asset('images/pj.jpg') }}" alt="First slide">
                                    </div>
                                    <div class="carousel-comment">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque non est sed elit malesuada semper. Sed a odio nec dui dignissim pharetra. Phasellus consectetur, neque vehicula bibendum porta, neque sapien mollis elit, nec lacinia enim libero non sem. Morbi maximus luctus velit, in varius neque.</p>
                                    </div>
                                </div>
                            </div>
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
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush