@extends('layouts.app_menu')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- Libreria español -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>

<div id="app">

    <div class="row justify-content-center" id="app">

        <div id="modalPrestamo" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="modelo.id > 0" class="modal-title" id="exampleModalLabel">Editar Prestamo</h5>
                        <h5 v-else class="modal-title" id="exampleModalLabel">Solicitar Prestamo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div class="container">
                    <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="selectCliente">Cliente</label>
                            <select :disabled="cargando || modelo.id_prestamo > 0" placeholder="Seleccione" style="width: 100%;" 
                            class="select-obj" id="selectCliente" name="selectCliente">
                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label>Saldo</label>
                            <input disabled type="text" value="0.00" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label>Salario</label>
                            <input disabled type="text" value="8,500.00" class="form-control">

                        </div>
                    </div>                  
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Plazo</label>
                            <select placeholder="Seleccione" style="width: 100%;" 
                            class="select-obj" id="select plazo" name="select plazo">
                            <option value="3">3 Meses</option>
                            <option value="6">6 Meses</option>
                            <option value="12">1 Año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Monto</label>
                            <input type="number" value="" class="form-control">
                        </div>          
                        <div class="col-md-3">
                            <label>Pago quincenal</label>
                            <input type="text" value="1,500.00" disabled class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Total a pagar</label>
                            <input type="text" value="20,000.00" disabled class="form-control">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Historial Crediticio</label>
                            <input value="Bueno" disabled type="text" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Identificación</label><br>
                            <button title="Descargar Identificación." class="btn btn-secondary btn-sm">
                                <i class="fa fa-download"></i>
                            </button>

                            
                        </div>                  
                        <div class="col-md-3">
                            <label>C. de domicilio</label><br>
                            <button title="Descargar comprobane de domicilio." class="btn btn-secondary btn-sm">
                                <i class="fa fa-download"></i>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <label>C. de ingresos</label><br>
                            <button title="Descargar comprobane de ingresos." class="btn btn-secondary btn-sm">
                                <i class="fa fa-download"></i>
                            </button>
                        </div>
                    </div>
                    <br>
                    <br>

                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <button v-if="modelo.id > 0" type="button" class="btn btn-success" :disabled="guardando"
                            id="btnRegistrar" @click="actualizarAval()">
                            <template v-if="guardando"><i class="fas fa-spinner fa-spin"></i> Guardando</template>
                            <template v-else> Solicitar Prestamo</template>
                        </button>
                        </button>
                        <button v-else type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando"
                            @click="guardarNuevoPrestamo()" >
                            <template v-if="guardando"><i class="fas fa-spinner fa-spin"></i> Guardando</template>
                            <template v-else> Solicitar </template>
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
    var urlBuscarCliente = '{{ url('/clientes/buscarCliente') }}';
</script>
<script src="{{ url('/js/prestamos/index.js') }}"></script>
@endsection
