@extends('layouts.app_menu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
        <div class="card-header">
            <h5 class="title">Editar Sucursal</h5>
        </div>
        <div class="card-body">
            <form action="{{url('/sucursal/actualizar')}}" method="POST" id="formEnvio">
            @csrf
            <input id="id" name="id" type="hidden" value="{{$sucursal->ID_Sucursal}}">
            <div class="row">
                <div class="col-md-8 pr-1">
                <div class="form-group">
                    <label>Sucursal</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Sucursal"
                    value="{{ old('nombre', $sucursal->Nombre_Empresa) }}"
                    name="nombre"
                    />
                </div>
                </div>
                <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>Capital</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Capital"
                    value="{{ old('capital', $sucursal->Capital) }}"
                    name="capital"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 pr-1">
                <div class="form-group">
                    <label>Dirección</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Domicilio"
                    value="{{ old('Direccion', $sucursal->Direccion) }}"
                    name="direccion"
                    />
                </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <a class="btn btn-secondary" href="{{url('/sucursal')}}" id="btnCancelar">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success" id="btnRegistrar">
                Actualizar Sucursal
                </button>
            </div>
            </form>
            <br />
        </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $( "#btnRegistrar" ).click(function() {
            $( "#btnRegistrar" ).html('<i class="fa fa-spinner fa-spin"></i> Cargando');
            $( "#btnRegistrar" ).prop( "disabled", true );
            $( "#btnCancelar" ).hide();
            $( "#formEnvio" ).submit();
        });

        @if(session()->has('message'))
            $.notify({
                // options
                message: '{{ session()->get('message') }}' 
            },{
                // settings
                type: '{{ session()->get('alert-type', 'info') }}'
            });
        @endif
    });
</script>

@endsection