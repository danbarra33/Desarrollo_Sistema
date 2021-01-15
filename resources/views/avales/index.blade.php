@extends('layouts.app_menu')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- Libreria español -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

<style>
    .fila:hover {
        background-color: #86CFAD;
        cursor: pointer;
    }

    .data-notify {
        z-index: 9999 !important;
    }

</style>
<div id="app"> 



    <div class="row justify-content-center" id="app">

        <div id="modalAval" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="modelo.id > 0" class="modal-title" id="exampleModalLabel">Editar Avales</h5>
                        <h5 v-else class="modal-title" id="exampleModalLabel">Crear Aval</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-6 pr-1">
                        <label for="selectCliente">Cliente</label>
                        <select style="width: 100%;" class="select-obj" id="selectCliente" name="selectCliente">
                        </select>

                            <!--
                                <div class="form-group">
                                <label>Buscar Cliente</label>
                                <input v-model="modelo.Buscar" type="text" class="form-control"
                                    placeholder="Buscar Cliente" value="" name="buscar" id="txtBox_BuscarCliente"
                                    oninput="BuscarCliente()" />
                            </div>-->
                        
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>ID Cliente</label>
                                <input v-model="modelo.id_cliente" type="text" class="form-control"
                                    placeholder="ID Cliente" value="" name="ID Cliente" id="strID_Cliente" />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>CURP</label>
                                <input v-model="modelo.curp" type="text" class="form-control" placeholder="CURP"
                                    value="" name="curp" id="strCurp" />
                            </div>
                        </div>
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>RFC</label>
                                <input v-model="modelo.rfc" type="text" class="form-control" placeholder="RFC" value=""
                                    name="rfc" id="strRfc" />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Folio INE</label>
                                <input v-model="modelo.folio_ine" type="text" class="form-control" placeholder="Folio INE"
                                    value="" name="folio" id="strFolio" />
                            </div>
                        </div>
                        <div class="col-md-5 pr-1">
                            <div class="form-group">
                                <label>Telefono</label>
                                <input v-model="modelo.telefono" type="text" class="form-control" placeholder="Telefono"
                                    value="" name="telefono" id="strTelefono" />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10 pr-1">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input v-model="modelo.direccion" type="text" class="form-control"
                                    placeholder="Dirección" value="" name="direccion" id="strDireccion" />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <button data-dismiss="modal" class="btn btn-secondary" href="" id="btnCancelar">
                            Cancelar
                        </button>
                        <button v-if="modelo.id > 0" type="button" class="btn btn-success" :disabled="guardando"
                            id="btnRegistrar" @click="actualizarAval()">
                            <template v-if="guardando"><i class="fas fa-spinner fa-spin"></i> Guardando</template>
                            <template v-else> Actualizar Aval</template>
                        </button>
                        </button>
                        <button v-else type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando"
                            @click="guardarNuevoAval()" >
                            <template v-if="guardando"><i class="fas fa-spinner fa-spin"></i> Guardando</template>
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
                    <button @click="crearAval()" title="Agregar Aval" class="btn btn-success"><i
                            class="fas fa-user-plus"></i></button>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>ID Aval</th>
                                <th>Nombre</th>
                                <th>Folio INE</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>RFC</th>
                                <th>ID Cliente</th>
                                <th>CURP</th>
                            </thead>
                            <tbody>
                                <tr class="fila" v-for="(aval, index) in listado" @click="editarAval(index)">
                                    <td><?php echo "{{ aval.id_aval }}" ?></td>
                                    <td><?php echo "{{ aval.nombre }}" ?></td>
                                    <td><?php echo "{{ aval.folio_ine }}" ?></td>
                                    <td><?php echo "{{ aval.direccion }}" ?></td>
                                    <td><?php echo "{{ aval.telefono }}" ?></td>
                                    <td><?php echo "{{ aval.rfc }}" ?></td>
                                    <td><?php echo "{{ aval.id_cliente }}" ?></td>
                                    <td><?php echo "{{ aval.curp }}" ?></td>
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
    function BuscarCliente() {
        var x = document.getElementById("txtBox_BuscarCliente").value;
        document.getElementById("demo").innerHTML = "You wrote: " + x;
    }

</script>
<script>
    var urlListado = '{{ url('/avales/listado') }}';
    var urlCrear = '{{ url('/avales/crear') }}';
    var urlActualizar = '{{ url('/avales/actualizar') }}';

    var urlBuscarCliente = '{{ url('/clientes/buscarCliente') }}';


    console.log('{{csrf_token()}}');

</script>
<script src="{{ url('/js/avales/index.js') }}"></script>
@endsection











