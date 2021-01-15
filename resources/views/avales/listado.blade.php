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
            <button @click="crearAval()" title="Agregar Aval" class="btn btn-success"><i class="far fa-plus-square"></>></i></button>
          </div>
      <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead class="text-primary">
          <th>ID Aval</th>
          <th>ID Cliente</th>
          <th>Nombre</th>
          <th>Direccion</th>
          <th>Folio INE</th>
          <th>CURP</th>
          <th>RFC</th>
          <th>Telefono</th>
        </thead>
        <tbody>
            <tr class="fila" v-for="(aval, index) in listado" @click="editarAval(index)">
                <td><?php echo "{{aval.id_aval}}" ?></td>
                <td><?php echo "{{aval.id_cliente}}" ?></td>
                <td><?php echo "{{aval.nombre}}" ?></td>
                <td><?php echo "{{aval.direccion}}" ?></td>
                <td><?php echo "{{aval.folio_ine}}" ?></td>
                <td><?php echo "{{aval.curp}}" ?></td>
                <td><?php echo "{{aval.rfc}}" ?></td>
                <td><?php echo "{{aval.telefono}}" ?></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
    </div>
  </div>
  <script>
    var urlListado = '{{url('/avales/listado')}}';
    var urlCrear = '{{url('/avales/crear')}}';
</script>
<script src="{{url('/js/avales/index.js')}}"></script>
@endsection