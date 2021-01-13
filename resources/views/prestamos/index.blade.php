@extends('layouts.app_menu')

@section('content')

<div id="app">

    <div class="row justify-content-center" id="app">

        <div id="modalPrestamo" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="modelo.id > 0" class="modal-title" id="exampleModalLabel">Editar Prestamo</h5>
                        <h5 v-else class="modal-title" id="exampleModalLabel">Crear Prestamo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Cliente</label>
                                <input v-model="modelo.id_cliente" type="text" class="form-control"
                                    placeholder="ID Cliente" value="" name="ID Cliente" id="strID_Cliente" />
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
                            <template v-else> Actualizar Prestamo</template>
                        </button>
                        </button>
                        <button v-else type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando"
                            @click="guardarNuevoPrestamo()" >
                            <template v-if="guardando"><i class="fas fa-spinner fa-spin"></i> Guardando</template>
                            <template v-else> Añadir Prestamo</template>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Prestamos</h4>
                    <button @click="crearPrestamo()" title="Agregar Prestamo" class="btn btn-success"><i
                            class="fas fa-user-plus"></i></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>#</th>
                                <th>cliente</th>
                                <th>monto</th>
                                <th>saldo</th>
                                <th>estatus</th>
                            </thead>
                            <tbody >
                            <tr class="fila" v-for="(prestamo, index) in listado">
                                <td><?php echo "{{prestamo.id_prestamo}}" ?></td>
                                <td><?php echo "{{prestamo.nombreCliente}}" ?></td>
                                <td><?php echo "{{prestamo.monto_prestamo}}" ?></td>
                                <td><?php echo "{{prestamo.saldo}}" ?></td>
                                <td><?php echo "{{prestamo.status}}" ?></td>
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

</script>
<script src="{{ url('/js/prestamos/index.js') }}"></script>
@endsection
