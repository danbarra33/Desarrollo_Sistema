@extends('layouts.app_menu')

@section('content')
<style>
.fila:hover{
  background-color: #86CFAD;
  cursor: pointer;
}
</style>
<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Tipos de pago</h4>
      </div>
      <div class="card-body">
        <div>
        <label>Seleccione método de pago</label>
        </div>

        <div>
          <select name="select" class="btn btn-secondary">
            <option value="value1">Efectivo</option>
            <option value="value2" selected>Tarjeta de debito</option>
            <option value="value3">Tarjeta de crédito</option>
          </select>
        </div>

        <div>
          <div class="row">
            <div class="col-4">
              <label>Monto a pagar</label>
              <div class="form-inline">
                <input type="efectivo" class="form-control" placeholder="Monto" id="evectivo">
              </div>
            </div>
            
            <div class="col-8">
              <label>Número de la tarjeta</label>
              <div class="form-inline">
                <input type="efectivo" class="form-control" placeholder="0000 0000 0000 0000" id="evectivo">
              </div>
            </div>
          </div>
        </div>

        <div>
        <div class="row">
          <div class="col-12">
            <label>Referencia</label>
              <div class="form-inline">
                <input type="efectivo" class="form-control" placeholder="Referencia" id="evectivo">
              </div>
          </div>
        </div>
        </div>

      <button class="btn btn-success btn-block btn-sm">Realizar pago</button>

      </div>
    </div>
  </div>

@endsection