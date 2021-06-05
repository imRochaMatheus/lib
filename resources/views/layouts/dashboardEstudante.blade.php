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
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush