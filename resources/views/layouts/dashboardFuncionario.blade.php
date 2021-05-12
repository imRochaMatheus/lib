@extends('layouts.partials.master')
@section('conteudo')
    <div class="col-md-12">
        <div class="mb-4">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card welcome-block">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Bem-vindo, {{$nome}}!</strong></h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card block">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Dorime</strong></h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card block">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Ameno</strong></h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card block">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Ratire</strong></h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
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
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
