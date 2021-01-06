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
            <h4 class="card-title">Avales</h4>
            <button @click="crearEmpleado()" title="Agregar Empleado" class="btn btn-success"><i class="fas fa-user-plus"></i></button>
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
  <script>
    var urlListado = '{{url('/empleados/listado')}}';
    var urlCrear = '{{url('/empleados/crear')}}';
</script>
<script src="{{url('/js/empleados/index.js')}}"></script>
@endsection