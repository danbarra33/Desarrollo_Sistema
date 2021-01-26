@extends('layouts.app_menu')

@section('content')
<style>
.fila:hover{
  background-color: #86CFAD;
  cursor: pointer;
}
.data-notify { 
  z-index: 9999 !important; 
}
</style>
<div id="app">

<div class="row justify-content-center" id="app">

  <div id="modalSucursal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 v-if="modelo.id_sucursal > 0" class="modal-title" id="exampleModalLabel">Editar sucursal</h5>
          <h5 v-else class="modal-title" id="exampleModalLabel">Crear sucursal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <br>
            <div class="row">
                <div class="col-md-8 pr-1">
                <div class="form-group">
                    <label>Sucursales</label>
                    <input
                    v-model = "modelo.nombre_empresa"
                    type="text"
                    class="form-control"
                    placeholder="Sucursal"
                    value=""
                    name="nombre"
                    id="strNombre"
                    />
                </div>
                </div>
                <div class="col-md-4 pr-1">
                <div class="form-group">
                    <label>Capital</label>
                    <input
                    v-model = "modelo.capital"
                    type="number"
                    class="form-control"
                    placeholder="Capital"
                    value=""
                    name="capital"
                    id="intCapital"
                    />
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 pr-1">
                <div class="form-group">
                    <label>Dirección</label>
                    <input
                    v-model = "modelo.direccion"
                    type="text"
                    class="form-control"
                    placeholder="Domicilio"
                    value=""
                    name="direccion"
                    id="strDomicilio"
                    />
                </div>
                </div>
            </div>
            </div>
            <div class="row d-flex justify-content-center">
                <button data-dismiss="modal" class="btn btn-secondary" href="" id="btnCancelar">
                    Cancelar
                </button>
                <button v-if="modelo.id_sucursal > 0" type="button" class="btn btn-success" :disabled="guardando"
                id="btnRegistrar" @click="actualizarSucursal()">
                  <template v-if="guardando"><i  class="fas fa-spinner fa-spin"></i> Guardando</template>
                  <template v-else> Actualizar Sucursal</template>
                </button>
                </button>
                <button v-else type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando"
                  @click="guardarNuevaSucursal()" >
                  <template v-if="guardando"><i  class="fas fa-spinner fa-spin"></i> Guardando</template>
                  <template v-else> Crear Sucursal</template>
                </button>
            </div>
      </div>
    </div>
  </div>

  <div class="col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Buro Credito Interno</h4>
        
        <button @click="crearSucursal()" title="Agregar Sucursal" class="btn btn-success"><i class="fas fa-user-plus"></i></button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID Cliente</th>
              <th>Fecha de Ingreso</th>
              <th>Saldo a Deber</th>
              <th>Status</th>
            </thead>
            <tbody>
                <tr class="fila" v-for="(BuroCredito, index) in listado">
                    <td><?php echo "{{BuroCredito.id_cliente}}" ?></td>
                    <td><?php echo "{{BuroCredito.fecha_ingreso}}" ?></td>
                    <td><?php echo "{{BuroCredito.saldodeudor}}" ?></td>
                    <td><?php echo "{{BuroCredito.status}}" ?></td>
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
     var urlListado = '{{url('/sucursales/listado')}}';
    var urlCrear = '{{url('/sucursales/crear')}}';
    var urlActualizar = '{{url('/sucursales/actualizar')}}';
</script>
<script src="{{url('/js/sucursales/index.js')}}"></script>
@endsection