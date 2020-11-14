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
        <h4 class="card-title">Clientes</h4>
        <a href="{{url('/clientes/agregar')}}" title="Agregar Cliente" class="btn btn-success"><i class="fas fa-user-plus"></i></a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th>ID Cliente</th>
              <th>Nombre Completo</th>
              <th>Folio INE</th>
              <th>Domocilio</th>
              <th>Telefono</th>
              <th>Estatus</th>
              <th>Salario Mensual</th>
            </thead>
            <tbody>
              @foreach ($clientes as $cliente)
              <tr class="fila" data-id="{{$cliente->id_cliente}}" title="Click para editar">
                <td>{{$cliente->id_cliente}}</td>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->folio_ine}}</td>
                <td>{{$cliente->direccion}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->status == "A" ? "Activo" : "Inactivo"}}</td>
                <td>$ {{$cliente->salario_mensual}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script>
      $(document).ready(function() {
        @if(session()->has('message'))
            $.notify({
                // options
                message: '{{ session()->get('message') }}' 
            },{
                // settings
                type: '{{ session()->get('alert-type', 'info') }}'
            });
        @endif

        $( ".fila" ).click(function() {      
          window.location.href = "{{url('/clientes/editar')}}?id="+$(this).data('id');
        });

      });
  </script>
@endsection