@extends('layouts.app_menu')

@section('content')
<style>
.fila:hover{
  background-color: #86CFAD;
  cursor: pointer;
}
</style>

<div class="row justify-content-center" id="app">
  <div class="modal fade" id="create">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h4>Crear</h4>
                  <button type="button" class="close" data-dismiss="modal">
                      <span>×</span>
                  </button>
                  
              </div>
              <div class="modal-body">
                <!-- <div class="row justify-content-center">  -->
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div><label>Cliente</label></div>
                        <div class="form-group"> 
                            <select name="select" class="btn btn-secondary">
                              <option value="value1">Cliente 1</option>
                              <option value="value2" selected>Cliente 2</option>
                              <option value="value3">Cliente 3</option>
                              <option value="value3">Cliente 4</option>
                              <option value="value3">Cliente 5</option>
                              <option value="value3">Cliente 6</option>
                            </select>
                        </div>
                    </div>
                </div>
                    
                <div class="row ">
                    <div class="col-md-4 pr-1">
                      <label>Saldo</label>
                        <div class="form-group">
                          <input  v-model="message" class="form-control" id="SaldoCliente" placeholder="$" readonly >
                        </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <label>Nuevo abono</label>
                        <div class="form-group">
                          <input v-model="message" class="form-control" id="SaldoCliente" placeholder="$">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                  <input type="submit" class="btn btn-primary" value="Abonar">
              </div>
              </div>
          </div>
      </div>
  </div>

    
    
    <!-- ------------------TABLA-------------------  -->
    <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Pagos</h4>
            <a href="#" class="btn btn-success pull-left" data-toggle="modal" data-target="#create"><i class="fas fa-user-plus"></i></a>
          </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>id_pago</th>
              <th>id_cliente</th> 
              <th>Nombre Cliente</th>
              <th>id_prestamo</th>
              <th>Monto</th>
              <th>Restante</th>
            </thead>
            <tbody>
              <tr class="fila" v-for="(pago, index) in listado" @click="editarEmpleado(index)">
                  <td><?php echo "{{pago.id_pago}}" ?></td>
                  <td><?php echo "{{pago.id_cliente}}" ?></td>
                  <td><?php echo "{{pago.nombreCliente}}" ?></td>
                  <td><?php echo "{{pago.id_prestamo}}" ?></td>
                  <td><?php echo "{{pago.monto}}" ?></td>
                  <td><?php echo "{{pago.restante}}" ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

</div>
















<!--       ----------------------- ESTO SI FUNCIONA ---------------------------
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
-->
@endsection

















