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
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="card-content-img">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card block">
                        <div class="card-body">
                            <div class="card-content">
                                <div class="card-content-info">
                                    <h5 class="card-title"><strong>Realizar Empréstimo</strong></h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="card-content-img">
                                    <i class="fas fa-book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
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
                </div>
                <div class="col-md-6">
                    <div class="card block">
                        <div class="card-body">
                            <div class="card-content">
                                <div class="card-content-info">
                                    <h5 class="card-title"><strong>Relatórios</strong></h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="card-content-img">
                                    <i class="fas fa-print"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="charts">
            <div class="row">
                <div class="col-md-8">
                    <div class="card chart">
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card chart">
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
