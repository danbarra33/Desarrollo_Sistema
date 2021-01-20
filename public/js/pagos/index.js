$(document).ready(function () {
    $.fn.select2.defaults.set('language', 'es');
    $('.select-obj').select2();

    $('#selectMetodoPago').select2({
        placeholder: "Seleccione",
        maximumInputLength: 100,
        minimumInputLength: 0,
        ajax: {
            url: urlMetodosPagoSelect2,
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
        app.cargarCliente(data.id);
        /*
        app.modelo.id_cliente = data.id;
        console.log(data.id);
        */
    });

});



var app = new Vue({
    el: '#app',
    data: { 
        listado: [],
        index: 0,
        guardando: false,
        cargando: false,
        modelo:{
            id_cliente: 0,
            saldo: 0
        }
    }, 
    mounted: function(){
        this.cargarPagos(urlListar);

    },
    methods: {
        cargarCliente: function (id) {
            // this.modelo.id_cliente = id;
            // console.log("Se actualizó el ID a " + this.modelo.id_cliente);
            axios.get(urlCargarCliente+'?id_cliente='+id)
                .then(response => {
                    this.modelo.saldo = response.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },
        cargarPagos: function (url) {
            axios.get(url)
                .then(response => {
                    if (response.data.codigo == 1) {
                        this.listado = response.data.listado;
                    } else {
                        $.notify({
                            message: response.data.mensaje
                        }, {
                            type: 'danger',
                            z_index: 99999
                        });
                    }
                })
                .catch(e => {
                    console.log(e);
                })
        }
    }
});


