@extends('layouts.app_menu')

@section('content')
<style>
.fila:hover{
  background-color: #86CFAD;
  cursor: pointer;
}
</style>
<div id="app">

<div class="row justify-content-center" id="app">
  <div class="col-md-10">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Sucursal</h4>
        
        <a href="" title="Agregar Sucursal" class="btn btn-success"><i class="fas fa-user-plus"></i></a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID Sucursal</th>
              <th>Capital</th>
              <th>Empresa</th>
              <th>Direccion</th>
            </thead>
            <tbody>
                <tr v-for="sucursal in listado">
                    <td><?php echo "{{sucursal.ID_Sucursal}}" ?></td>
                    <td><?php echo "{{sucursal.Capital}}" ?></td>
                    <td><?php echo "{{sucursal.Nombre_Empresa}}" ?></td>
                    <td><?php echo "{{sucursal.Direccion}}" ?></td>
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
</script>
<script src="{{url('/js/sucursales/index.js')}}"></script>
@endsection

