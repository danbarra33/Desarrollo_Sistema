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
<!-- ------ INICIO MODAL ------- -->  
      <div class="modal fade" id="ModalMetodos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel">Agregar método de pago</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="FormMetodoPago">Nuevo método de pago:</label>
                <textarea class="form-control" id="FormMetodoPago" rows="1" placeholder="Método de pago"></textarea>
              </div>

              <div class="row justify-content-center">
                  <button data-dismiss="modal" class="btn btn-secondary" href="" id="btnCancelar">Cancelar</button>
                  <button data-dismiss="modal" class="btn btn-success" href="" id="btnNuevoMetodo">Aceptar</button>

                    <!--button v-if="modelo.id_tipo_pago > 0" type="button" class="btn btn-success" :disabled="guardando"
                        id="btnNuevoModelo" @click="actualizarMetodo()">
                        <template v-if="guardando"><i class="fas fa-spinner fa-spin"></i> Guardando</template>
                        <template v-else> Actualizar Aval</template>
                    </button>
                    <button v-else type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando"
                        @click="actualizarMetodo()" >
                        <template v-if="guardando"><i class="fas fa-spinner fa-spin"></i> Guardando</template>
                        <template v-else> Añadir Aval</template>
                    </button -->
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- -------- FIN MODAL -------- --> 
      <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Método de Pago</h4>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalMetodos"><i class="fas fa-user-plus"></i></button>        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class="text-primary">
                <th>ID</th>
                <th>Nombre</th>
              </thead>
              <tbody>
                  <tr class="fila" v-for="(tipo, index) in listado" @click="editar(index)">
                      <td><?php echo "{{tipo.id_tipo_pago}}" ?></td>
                      <td><?php echo "{{tipo.tipo}}" ?></td>
                  </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
  <script>
    //var urlListado = '{{url('/pagos/tipos/listado')}}';
    //var urlCrear = '{{url('/empleados/crear')}}';
</script>
<script src="{{url('/js/pagos/tipos/index.js')}}"></script>
@endsection