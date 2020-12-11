@extends('layouts.app_menu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
        <div class="card-header">
            <h5 class="title">Añadir Empleado</h5>
        </div>
        <div class="card-body">
            <form action="{{url('/empleado/nuevo')}}" method="POST" id="formEnvio">
            @csrf
            <div class="row">
                <div class="col-md-6 pr-1">
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
                    <div class="col-md-6 pr-1">
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
                </div>
                <div class="row">
                        <div class="col-md-4 pr-1">
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
                    <div class="col-md-4 px-1">
                    <div class="form-group">
                        <label>Correo Electronico </label>
                        <input
                        type="text"
                        class="form-control"
                        placeholder="Correo Electronico"
                        value="{{ old('email') }}"
                        name="email"
                        />
                    </div>
                    </div>
                <div class="col-md-4 px-1">
                <div class="form-group">
                    <label>Contraseña</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Contraseña"
                    value="{{ old('Contraseña') }}"
                    name="password"
                    />
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6 pl-1">
                <div class="form-group">
                    <label>Sucursal</label>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Sucursales
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Centro</a>
                          <a class="dropdown-item" href="#">Barranchos</a>
                          <a class="dropdown-item" href="#">o Cualquier otro</a>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-6 pl-1">
                    <div class="form-group">
                        <label>Tipo de Usuario</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Tipo de Usuario
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Empleado</a>
                              <a class="dropdown-item" href="#">Supervisor</a>
                              <a class="dropdown-item" href="#">Gerente</a>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="row d-flex justify-content-center">
                <a class="btn btn-secondary" href="{{url('/empleados')}}" id="btnCancelar">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-success" id="btnRegistrar">
                Registrar Empleado
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