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
              <h4>Nuevo pago</h4>
                  <button type="button" class="close" data-dismiss="modal">
                      <span>×</span>
                  </button>  
              </div>

              <div class="modal-body">
              <div class="row">
                    <div class="col-md-5">
                      <label for="selectCliente">Cliente</label>
                      <div><select :disabled="cargando || modelo.pagos > 0" placeholder="Seleccione" style="width: 80%;" 
                        class="select-obj" id="selectCliente" name="selectCliente">
                        </select></div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <label>Saldo</label>
                          <input disabled type="text" value="0.00" class="form-control">
                      </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Nuevo abono</label>
                        <input v-model="message" class="form-control" id="SaldoCliente" placeholder="$">
                      </div>
                    </div>
                    <div class="col-md-6">
                    <label for="selectCliente">Método de pago</label>
                    <div><select :disabled="cargando || modelo.TipoPago > 0" placeholder="Seleccione" style="width: 80%;" 
                        class="select-obj" id="selectTipoPago" name="selectTipoPago">
                        </select></div>

                    </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success" value="Abonar">
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
              <tr class="fila" v-for="(Pagos, PagosIndex) in listado" >
                  <td><?php echo "{{pagos.id_pago}}" ?></td>
                  <td><?php echo "{{pagos.id_cliente}}" ?></td>
                  <td><?php echo "{{pagos.nombreCliente}}" ?></td>
                  <td><?php echo "{{pagos.id_prestamo}}" ?></td>
                  <td><?php echo "{{pagos.monto}}" ?></td>
                  <td><?php echo "{{pagos.restante}}" ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection

















