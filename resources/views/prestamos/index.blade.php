@extends('layouts.app_menu')

@section('content')
<script src="https://unpkg.com/bootstrap-vue@2.16.0/dist/bootstrap-vue.min.js"></script>
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
                            <select :disabled="cargando" placeholder="Seleccione" style="width: 100%;" 
                            class="select-obj" id="selectCliente" name="selectCliente">
                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label>Saldo</label>
                            <input disabled type="text" v-model="estadoCliente.saldo" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <label>Salario</label>
                            <input disabled type="text" v-model="estadoCliente.salario" class="form-control">

                        </div>
                    </div>                  
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Plazo</label>
                            <select placeholder="Seleccione" style="width: 100%;" 
                            class="select-obj" id="selectPlazo" name="selectPlazo">
                            <option value="3">3 Meses</option>
                            <option value="6">6 Meses</option>
                            <option value="12">1 Año</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Monto</label>
                            <input type="number" v-model="modelo.monto" @change="validar" class="form-control">
                        </div>          
                        <div class="col-md-3">
                            <label>Pago quincenal</label>
                            <input type="text" v-model="modelo.pagoQuincenal" disabled class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Total a pagar</label>
                            <input type="text" v-model="modelo.totalPagar" disabled class="form-control">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Historial Crediticio</label>
                            <input :value="estadoCliente.historial == 'b' ? 'Bueno' : estadoCliente.historial == 'm' ? 'Malo' : 'Nuevo'" disabled type="text" class="form-control">
                        </div> 
                        
                        <div class="col-md-3">
                            <label>C. de domicilio</label><br>
                            <a title="Descargar Identificación actual." class="btn btn-secondary btn-sm"
                            :disabled='estadoCliente.id_cliente == 0 || guardando || cargando'
                            :href="'{{url('/clientes/descargar')}}?id_cliente='+estadoCliente.id_cliente+'&documento=INE'" 
                            download="Identificación del cliente"><i class="fa fa-download"></i></a>
                        </div>

                        <div class="col-md-3">
                            <label>C. de domicilio</label><br>
                            <a title="Descargar Comprobante de Domicilio actual." class="btn btn-secondary btn-sm"
                            :disabled='estadoCliente.id_cliente == 0 || guardando || cargando'
                            :href="'{{url('/clientes/descargar')}}?id_cliente='+estadoCliente.id_cliente+'&documento=Domicilio'" 
                            download="Comprobante de Domicilio del cliente"><i class="fa fa-download"></i></a>
                        </div>

                        <div class="col-md-3">
                            <label>C. de ingresos</label><br>
                            <a title="Descargar Comprobante de Ingresos actual." class="btn btn-secondary btn-sm"
                            :disabled='estadoCliente.id_cliente == 0 || guardando || cargando'
                            :href="'{{url('/clientes/descargar')}}?id_cliente='+estadoCliente.id_cliente+'&documento=ComprobanteIngresos'" 
                            download="Comprobante de Ingresos del cliente"><i class="fa fa-download"></i></a>
                        </div>

 
                    </div>
                    <br>
                    <br>

                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-success" id="btnRegistrar" :disabled="guardando || cargando || !modelo.valido"
                            @click="guardar()" >
                            <template v-if="guardando"><i class="fas fa-spinner fa-spin"></i> &nbsp;Guardando</template>
                            <template v-else-if="cargando"><i class="fas fa-spinner fa-spin"></i> &nbsp;Cargando</template>
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
                    <button @click="crearPrestamo()" title="Agregar Prestamo" class="btn btn-success">
                    <i class="fas fa-plus"></i>
                    </button>

                    <div class="form-inline my-2 my-lg-0 float-right" style="display: inline-block;">
                        <div class="input-group mb-3">                   
                            <input ref="search" class="form-control my-2 my-sm-0 w-50" type="search" placeholder="Buscar" aria-label="Search" 
                            v-on:keyup.enter.prevent="search()" v-model="busqueda">
                            <div class="input-group-prepend">
                                <button :disabled="cargando" class="btn btn-success my-2 my-sm-0 rounded-right" type="button" @click.prevent="search()">
                                    <i class="fas fa-search fa-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Plazo</th>
                                <th>Monto</th>
                                <th>Saldo</th>
                                <th>Estatus</th>
                            </thead>
                            <tbody >
                            <tr class="fila" v-for="(prestamo, index) in listado">
                                <td><?php echo "{{prestamo.id_prestamo}}" ?></td>
                                <td><?php echo "{{prestamo.nombreCliente}}" ?></td>
                                <td><?php echo "{{prestamo.fecha_prestamo}}" ?></td>
                                <td><?php echo "{{prestamo.plazo == 12 ? '1 Año' : (prestamo.plazo + ' Meses') }}" ?></td>
                                <td><?php echo "{{prestamo.monto_prestamo}}" ?></td>
                                <td><?php echo "{{prestamo.saldo}}" ?></td>
                                <td><?php echo "{{prestamo.status == 'A' ? 'Autorizado' : (prestamo.status == 'P' ? 'Pagado' : (prestamo.status == 'S' ? 'Sin Autorizar' : 'Cancelado')) }}" ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <template v-if="paginacion.total / paginacion.per_page > 1">
                        <b-pagination
                        :disabled ="cargando"
                        @input = "(page) => paginateClick(page)"
                        v-model="paginacion.current_page"
                        :total-rows="paginacion.total"
                        :per-page="paginacion.per_page"
                        :limit="6"
                        first-number
                        last-number
                        align="center"
                        >
                        </b-pagination>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var urlBuscarCliente = '{{ url('/clientes/buscarCliente') }}';
    var urlEstadoCliente = '{{ url('/clientes/estado') }}';
    var urlListado = '{{ url('/prestamos/listado') }}';
    var urlGuardar = '{{ url('/prestamos/guardar') }}';
</script>
<script src="{{ url('/js/prestamos/index.js') }}"></script>
@endsection
