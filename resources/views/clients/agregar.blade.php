@extends('layouts.app_menu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
        <div class="card-header">
            <h5 class="title">Añadir Cliente</h5>
        </div>
        <div class="card-body">
            <form>
            <div class="row">
                <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Nombre Completo"
                    value=""
                    />
                </div>
                </div>
                <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label for="exampleInputEmail1"
                    >Correo Electronico</label
                    >
                    <input
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    />
                </div>
                </div>
                <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>Telefono</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Telefono"
                    value=""
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 pr-1">
                <div class="form-group">
                    <label>Domicilio</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Domicilio"
                    value=""
                    />
                </div>
                </div>
                <div class="col-md-4 px-1">
                <div class="form-group">
                    <label>Folio INE </label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Folio INE"
                    value=""
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 px-1">
                <div class="form-group">
                    <label>Salario Mensual</label>
                    <input
                    type="text"
                    class="form-control"
                    placeholder="Salario"
                    value=""
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
                    value=""
                    />
                </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <button type="button" class="btn btn-success">
                Registrar Cliente
                </button>
            </div>
            </form>
            <br />
        </div>
        </div>
    </div>
</div>
@endsection