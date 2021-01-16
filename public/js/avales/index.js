
$(document).ready(function () {
    $.fn.select2.defaults.set('language', 'es');
    $('.select-obj').select2();


    $('#selectCliente').select2({
        placeholder: "Seleccione cliente",
        maximumInputLength: 100,
        minimumInputLength: 1,
        ajax: {
            url: urlBuscarCliente,
            dataType: 'json',
            data: function (params) {
                var query = {
                    busqueda: params.term,
                    page: params.page || 1
                }
                return query;
            }
        }
    });

    $('#selectCliente').on('select2:select', function (e) {

        var data = e.params.data;
        app.actualizarID(data.id);
        /*
        app.modelo.id_cliente = data.id;
        console.log(data.id);
        */
    });

});

function select2AjaxSetValue(select, url, busqueda, value, callback) {
    $.ajax({
        url: url + "?" + busqueda + "=" + value,
        success: function (result) {
            console.log(result);
            $(select).select2("trigger", "select", {
                data: result
            });
            if (callback) {
                callback();
            }
        }
    });
}

var app = new Vue({
    el: '#app',
    data: {
        listado: [],
        index: 0,
        guardando: false,
        cargando: false,
        modelo: {
            id_aval: 0,
            id_cliente: 0,
            nombre: '',
            curp: '',
            rfc: '',
            folio_ine: '',
            direccion: '',
            telefono: ''
        }
    },
    mounted: function () {
        this.cargarAvales(urlListado);
    },
    methods: {
        actualizarID: function (id) {
            this.modelo.id_cliente = id;
            console.log("Se actualizó el ID a " + this.modelo.id_cliente);
        },
        cargarAvales: function (url) {
            axios.get(url)
                .then(response => {
                    if (response.data.codigo == 1) {
                        this.listado = response.data.listado;
                    } else {
                        $.notify({
                            message: response.data.mensaje
                        }, {
                            type: 'danger'
                        });
                    }
                })
                .catch(e => {
                    console.log(e);
                })
        },
        crearAval: function () {
            this.modelo = {
                id_aval: 0,
                id_cliente: 0,
                nombre: '',
                curp: '',
                rfc: '',
                folio_ine: '',
                direccion: '',
                telefono: ''
            };
            $('#selectCliente').val(null).trigger('change');
            $('#modalAval').modal('show');
        },
        actualizarAval: function () {
            this.guardando = true;
            axios.post(urlActualizar, this.modelo)
                .then(response => {
                    if (response.data.codigo == 1) {
                        $.notify({
                            message: response.data.mensaje
                        }, {
                            type: 'success',
                            z_index: 99999
                        });
                        this.cargarAvales(urlListado);
                        $('#modalAval').modal('hide');

                    } else {
                        $.notify({
                            message: response.data.mensaje
                        }, {
                            type: 'danger',
                            z_index: 99999
                        });
                    }
                    this.guardando = false;
                })
                .catch(e => {
                    console.log(e);
                    this.guardando = false;
                })
        },
        guardarNuevoAval: function () {
            this.guardando = true;
            axios.post(urlCrear, this.modelo)
                .then(response => {
                    if (response.data.codigo == 1) {
                        $.notify({
                            message: response.data.mensaje
                        }, {
                            type: 'success',
                            z_index: 99999
                        });
                        this.listado.push(response.data.aval);
                        $('#modalAval').modal('hide');
                    } else {
                        $.notify({
                            message: response.data.mensaje
                        }, {
                            type: 'danger',
                            z_index: 99999
                        });
                    }
                    this.guardando = false;
                })
                .catch(e => {
                    console.log(e);
                    this.guardando = false;
                })
        },
        cancelarModal: function () {

        },
        editarAval: function (index) {

            this.cargando = true;

            this.modelo = {
                id_aval: this.listado[index].id_aval,
                id_cliente: this.listado[index].id_cliente,
                nombre: this.listado[index].nombre,
                curp: this.listado[index].curp,
                rfc: this.listado[index].rfc,
                folio_ine: this.listado[index].folio_ine,
                direccion: this.listado[index].direccion,
                telefono: this.listado[index].telefono
            };

            select2AjaxSetValue("#selectCliente", urlBuscarCliente, "id", this.listado[index].id_cliente, function () {
                app.cargando = false;
            });

            this.index = index;
            $('#modalAval').modal('show');
        }
    }
});