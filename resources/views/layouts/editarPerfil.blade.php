@extends('layouts.partials.master')
@section('conteudo')
    
    <form id="editar-perfil-form" class="col-md-6 cadastro" action="{{ route('auth.on.usuario.editar') }}" method="POST" enctype="multipart/form-data">
        @csrf
       
        <div class="row">
            <div class="col-md-12 form-group foto">
                <img id="foto-atual" src="{{ asset($foto) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-1 form-group">
                <label for="foto" aria-hidden="true" hidden>Foto:</label>
                <input type="file" id="foto" name="foto" accept="image/*" required>
                <input type="hidden" id="usuario_id" name="usuario_id" value={{$id}}>
            </div>
        </div>

        <button type="submit" class="btn btn-block mt-4">TROCAR FOTO</button>
    </form>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/editar-perfil.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#foto').change(function() {
                if(this.files && this.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $('#foto-atual').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endpush