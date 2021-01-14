@extends('layouts.app_menu')

@section('content')
<style>
.fila:hover{
  background-color: #86CFAD;
  cursor: pointer;
}
.fila-borrar:hover{
  background-color: white;
  cursor: default;
}
</style>
<div class="row justify-content-center" id="app">

<div id="modalModelo" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 v-if="modelo.id_tipo_pago > 0" class="modal-title" id="exampleModalLabel">Editar Método de pago</h5>
          <h5 v-else class="modal-title" id="exampleModalLabel">Crear Método de pago</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <br>
            <div class="row">
                <div class="col-md-8 pr-1">
                <div class="form-group">
                    <label>Nombre</label>
                    <input
                    v-model = "modelo.tipo"
                    type="text"
                    class="form-control"
                    placeholder="Tipo de Pago"
                    value=""
                    name="tipo"
                    id="strTipo"
                    />
                </div>
                </div>
                <div class="col-md-3 pr-1">
                <label for="boolActivo">Activo</label>
                <br>
                  <input
                    v-model = "modelo.activo"
                    type="checkbox"
                    class=""
                    placeholder="Activo"
                    value=""
                    name="activo"
                    id="boolActivo"
                    />
                </div>
            </div>
            </div>
            <div class="row d-flex justify-content-center">
                <button data-dismiss="modal" class="btn btn-secondary" href="" id="btnCancelar">
                    Cancelar
                </button>
                <button v-if="modelo.id_tipo_pago > 0" type="button" class="btn btn-success" :disabled="guardando"
                id="btnRegistrar" @click="actualizar()">
                  <template v-if="guardando"><i  class="fas fa-spinner fa-spin"></i> Guardando</template>
                  <template v-else> Actualizar</template>
                </button>
                </button>
                <button v-else type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando"
                  @click="guardarNuevo()" >
                  <template v-if="guardando"><i  class="fas fa-spinner fa-spin"></i> Guardando</template>
                  <template v-else> Crear Método</template>
                </button>
            </div>
      </div>
    </div>
  </div>

    <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Método de Pago</h4>
            <button @click="crear()" title="Agregar Empleado" class="btn btn-success"><i class="fas fa-user-plus"></i></button>
          </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th style="width:100px;">ID</th>
              <th style="width:100%;">Nombre</th>
              <th style="width:100px;">borrar</th>
            </thead>
            <tbody>
                <tr class="fila" v-for="(tipo, index) in listado">
                    <td style="width:100px;" @click="editar(index)" title="Click para editar"><?php echo "{{tipo.id_tipo_pago}}" ?></td>
                    <td style="width:100%;" @click="editar(index)" title="Click para editar"><?php echo "{{tipo.tipo}}" ?></td>
                    <td style="width:100px;" class="fila-borrar"><button @click="borrar(index)" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    var urlListado = '{{url('/pagos/tipos/listado')}}';
    var urlCrear = '{{url('/pagos/tipos/crear')}}';
    var urlActualizar = '{{url('/pagos/tipos/actualizar')}}';
    var urlBorrar = '{{url('/pagos/tipos/borrar')}}';
</script>
<script src="{{url('/js/pagos/tipos/index.js')}}"></script>
@endsection