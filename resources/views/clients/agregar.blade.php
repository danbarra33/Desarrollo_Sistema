@extends('layouts.app_menu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
        <div class="card-header">
            <h5 class="title">Añadir Cliente</h5>
        </div>
        <div class="card-body">
            <form action="{{url('/clientes/nuevo')}}" method="POST" id="formEnvio" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Nombre Completo"
                    value="{{ old('nombre') }}"
                    name="nombre"
                    />
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label>Telefono</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Telefono"
                    value="{{ old('telefono') }}"
                    name="telefono"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                <div class="form-group">
                    <label>Domicilio</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Domicilio"
                    value="{{ old('domicilio') }}"
                    name="domicilio"
                    />
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label>Folio INE </label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Folio INE"
                    value="{{ old('folioINE') }}"
                    name="folioINE"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label>Salario Mensual</label>
                    <input
                    type="number"
                    class="form-control"
                    placeholder="Salario"
                    value="{{ old('Salario') }}"
                    name="Salario"
                    />
                </div>
                </div>
                <div class="col-md-6 pl-1">
                <div class="form-group">
                    <label>Status</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Status"
                    value="{{ old('status') }}"
                    name="status"
                    />
                </div>
                </div>
            </div>
            
            <div> 
            <label>Documentos</label>
            </div>
            <div>          
                <div class="col-md-4">
                    <div>
                        <label for="INE">Identificacion Personal</label>
                        <input type="file" id="INE" name="INE" accept="application/pdf"><br><br>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-md-4">
                    <div>
                        <label for="ComprobanteIngresos">Comprobante de Ingresos</label>
                        <input type="file" id="ComprobanteIngresos" name="ComprobanteIngresos" accept="application/pdf"><br><br>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-md-4">
                    <div>
                        <label for="ComprobanteDomicilio">Comprobante de Domicilio</label>
                        <input type="file" id="Domicilio" name="Domicilio" accept="application/pdf"><br><br>
                    </div>
                </div>
            </div> 

            <div class="row d-flex justify-content-center">
                <a class="btn btn-secondary" href="{{url('/clientes')}}" id="btnCancelar">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success" id="btnRegistrar">
                Registrar Cliente
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