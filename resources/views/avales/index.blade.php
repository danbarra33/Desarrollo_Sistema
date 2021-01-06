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

  <div id="modalAval" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 v-if="modelo.id > 0" class="modal-title" id="exampleModalLabel">Editar Avales</h5>
          <h5 v-else class="modal-title" id="exampleModalLabel">Crear Aval</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5 pr-1">
            <div class="form-group">
                <label>Nombre Completo</label>
                <input
                    v-model = "modelo.name"
                    type="text"
                    class="form-control"
                    placeholder="Nombre Completo"
                    value=""
                    name="nombre"
                    id="strName"
                />
            </div>
            </div>
                <div class="col-md-5 pr-1">
                <div class="form-group">
                    <label>Domicilio</label>
                    <input
                    v-model = "modelo.address"
                    type="text"
                    class="form-control"
                    placeholder="Domicilio"
                    value=""
                    name="address"
                    id="strAddress"
                    />
                </div>
                </div>
            </div>
            <div class="row justify-content-center">
                    <div class="col-md-4 pr-1">
                        <div class="form-group">
                            <label>Telefono</label>
                            <input
                            v-model = "modelo.phone"
                    type="text"
                    class="form-control"
                    placeholder="Telefono"
                    value=""
                    name="phone"
                    id="strPhone"
                            />
                        </div>
                        </div>
                <div class="col-md-3 px-1">
                <div class="form-group">
                    <label>Correo Electronico </label>
                    <input
                    v-model = "modelo.email"
                    type="text"
                    class="form-control"
                    placeholder="Correo Electronico"
                    value=""
                    name="email"
                    id="strEmail"
                    />
                </div>
                </div>
            <div class="col-md-3 px-1">
            <div class="form-group">
                <label>Contraseña</label>
                <input
                v-model = "modelo.password"
                    type="password"
                    class="form-control"
                    placeholder="Contraseña"
                    value=""
                    name="password"
                    id="strPassword"
                />
            </div>
            </div>
            </div>
            <div class="row justify-content-center">
            <div class="col-md-4 pl-1">
            <div class="form-group">
              <label>Sucursal</label>
                  <select v-model="modelo.id_sucursal">
                    <option disabled value="">Seleccione una Sucursal</option>
                    <option>Centro</option>
                    <option>Barranchos</option>
                    <option>Etc</option>
                  </select>
            </div>
            </div>
            <div class="col-md-4 pl-1">
              <div class="form-group">
                  <label>Tipo de Usuario</label>
                  <select v-model="modelo.type_of_user">
                    <option disabled value="">Seleccione un tipo de empleado</option>
                    <option>Empleado</option>
                    <option>Supervisor</option>
                    <option>Gerente</option>
                  </select>
              </div>
          </div>
        </div>
        
            <div class="row justify-content-center">
                <button data-dismiss="modal" class="btn btn-secondary" href="" id="btnCancelar">
                    Cancelar
                </button>
                <button v-if="modelo.id > 0" type="button" class="btn btn-success" :disabled="guardando"
                id="btnRegistrar" @click="actualizarAval()">
                  <template v-if="guardando"><i  class="fas fa-spinner fa-spin"></i> Guardando</template>
                  <template v-else> Actualizar Aval</template>
                </button>
                </button>
                <button v-else type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando"
                  @click="guardarNuevoAval()" >
                  <template v-if="guardando"><i  class="fas fa-spinner fa-spin"></i> Guardando</template>
                  <template v-else> Añadir Aval</template>
                </button>
            </div>
      </div>
    </div>
  </div>

  <div class="col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Avales</h4>
        <button @click="crearAval()" title="Agregar Aval" class="btn btn-success"><i class="fas fa-user-plus"></i></button>
      </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead class="text-primary">
          <th>ID Aval</th>
          <th>Folio INE</th>
          <th>Direccion</th>
          <th>Telefono</th>
          <th>RFC</th>
          <th>ID Cliente</th>
          <th>CURP</th>
        </thead>
        <tbody>
            <tr class="fila" v-for="(aval, index) in listado" @click="editarAval(index)">
                <td><?php echo "{{aval.id_aval}}" ?></td>
                <td><?php echo "{{aval.folio_ine}}" ?></td>
                <td><?php echo "{{aval.direccion}}" ?></td>
                <td><?php echo "{{aval.telefono}}" ?></td>
                <td><?php echo "{{aval.rfc}}" ?></td>
                <td><?php echo "{{aval.id_cliente}}" ?></td>
                <td><?php echo "{{aval.curp}}" ?></td>
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
var urlListado = '{{url('/avales/listado')}}';
var urlCrear = '{{url('/avales/crear')}}';
var urlActualizar = '{{url('/avales/actualizar')}}';
</script>
<script src="{{url('/js/avales/index.js')}}"></script>
@endsection