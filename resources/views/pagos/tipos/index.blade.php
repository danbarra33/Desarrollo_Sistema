@extends('layouts.app_menu')

@section('content')
<style>
.fila:hover{
  background-color: #86CFAD;
  cursor: pointer;
}
</style>
<div class="row justify-content-center" id="app">
    <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Método de Pago</h4>
            <button @click="crearEmpleado()" title="Agregar Empleado" class="btn btn-success"><i class="fas fa-user-plus"></i></button>
          </div>
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
  <script>
    //var urlListado = '{{url('/pagos/tipos/listado')}}';
    //var urlCrear = '{{url('/empleados/crear')}}';
</script>
<script src="{{url('/js/pagos/tipos/index.js')}}"></script>
@endsection