@extends('layouts.app_menu')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- Libreria español -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

<div id="app">
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
              <div class="col-md-6">
                <div class="form-group">

                  <label for="selectCliente">Cliente</label>
                  <select :disabled="cargando || modelo.id_prestamo > 0" placeholder="Seleccione" style="width: 100%;"
                    class="select-obj" id="selectCliente" name="selectCliente">
                  </select>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">

                  <label for="selectMetodoPago">Metodo de Pago</label>
                  <select :disabled="cargando || modelo.id_prestamo > 0" placeholder="Seleccione" style="width: 100%;"
                    class="select-obj" id="selectMetodoPago" name="selectMetodoPago">
                  </select>

                </div>
              </div>
            </div>

            <div class="row ">
              <div class="col-md-5 pr-1">
                <div class="form-group">
                  <label>Saldo</label>
                  <input v-model="modelo.saldo" disabled type="text" value="0.00" class="form-control">
                </div>
              </div>
              <div class="col-md-5 pr-1">
                <label>Nuevo abono</label>
                <div class="form-group">
                  <input :disabled="modelo.saldo <= 0" class="form-control" id="abonoCliente" placeholder="$">
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <input :disabled="modelo.saldo <= 0" type="submit" class="btn btn-success" value="Abonar">
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
          <a href="#" class="btn btn-success pull-left" data-toggle="modal" data-target="#create"><i
              class="fas fa-user-plus"></i></a>
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
                <tr class="fila" v-for="(pagos, index) in listado">
                  <td>
                    <?php echo "{{pagos.id_pago}}" ?>
                  </td>
                  <td>
                    <?php echo "{{pagos.id_cliente}}" ?>
                  </td>
                  <td>
                    <?php echo "{{pagos.nombreCliente}}" ?>
                  </td>
                  <td>
                    <?php echo "{{pagos.id_prestamo}}" ?>
                  </td>
                  <td>
                    <?php echo "{{pagos.monto}}" ?>
                  </td>
                  <td>
                    <?php echo "{{pagos.restante}}" ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var urlListar = '{{ url('/pagos/listar') }}';
  var urlBuscarCliente = '{{ url('/clientes/buscarCliente') }}';
  var urlMetodosPagoSelect2 = '{{ url('/pagos/tipos/select2') }}';
  var urlCargarCliente = '{{ url('/clientes/saldo') }}';
</script>
<script src="{{ url('/js/pagos/index.js') }}"></script>
@endsection