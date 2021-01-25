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

  <div id="modalEmpleado" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 v-if="modelo.id > 0" class="modal-title" id="exampleModalLabel">Editar Empleados</h5>
          <h5 v-else class="modal-title" id="exampleModalLabel">Crear Empleado</h5>
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
                id="btnRegistrar" @click="actualizarEmpleado()">
                  <template v-if="guardando"><i  class="fas fa-spinner fa-spin"></i> Guardando</template>
                  <template v-else> Actualizar Empleado</template>
                </button>
                </button>
                <button v-else type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando"
                  @click="guardarNuevoEmpleado()" >
                  <template v-if="guardando"><i  class="fas fa-spinner fa-spin"></i> Guardando</template>
                  <template v-else> Añadir Empleado</template>
                </button>
            </div>
      </div>
    </div>
  </div>

  <div class="col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Empleado</h4>
        <button @click="crearEmpleado()" title="Agregar Empleado" class="btn btn-success"><i class="fas fa-user-plus"></i></button>
        <a href="" title="Generar Reporte" class="btn btn-outline-success"><i class="fas fa-file-export"></i></a>
      </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead class="text-primary">
          <th>ID Empleado</th>
          <th>Nombre Completo</th>
          <th>Domicilio</th>
          <th>Telefono</th>
          <th>Correo Electronico</th>
          <th>Sucursal</th>
          <th>Tipo de Usuario</th>
        </thead>
        <tbody>
            <tr class="fila" v-for="(empleado, index) in listado" @click="editarEmpleado(index)">
                <td><?php echo "{{empleado.id}}" ?></td>
                <td><?php echo "{{empleado.name}}" ?></td>
                <td><?php echo "{{empleado.address}}" ?></td>
                <td><?php echo "{{empleado.phone}}" ?></td>
                <td><?php echo "{{empleado.email}}" ?></td>
                <td><?php echo "{{empleado.id_sucursal}}" ?></td>
                <td><?php echo "{{empleado.type_of_user}}" ?></td>
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
var urlListado = '{{url('/empleados/listado')}}';
var urlCrear = '{{url('/empleados/crear')}}';
var urlActualizar = '{{url('/empleados/actualizar')}}';
</script>
<script src="{{url('/js/empleados/index.js')}}"></script>
@endsection