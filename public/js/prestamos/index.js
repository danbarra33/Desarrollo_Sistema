
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
        app.actualizarId_cliente(data.id);
        /*
        app.modelo.id_cliente = data.id;
        console.log(data.id);
        */
    });

});

var app = new Vue({
    el: '#app',
    data: { 
        listado: [
            {"id_prestamo":1,"id_cliente":23,"nombreCliente":"pedro picapiedra","monto_prestamo":100,"saldo":23,"status":"Vigente"},
            {"id_prestamo":2,"id_cliente":24,"nombreCliente":"Miguel Hidalgo","monto_prestamo":500,"saldo":0,"status":"Pagado"},
            {"id_prestamo":3,"id_cliente":25,"nombreCliente":"María Sol","monto_prestamo":20,"saldo":100,"status":"Vigente"},
        ],
        index: 0,
        guardando: false,
        cargando: false,
        modelo:{
            id_cliente: 0,
            saldoCliente: 0,
            salario: 0,
            clienteMoroso: false,
            cantidadPrestamos: 1,
            capitalInicialSucursal: 0,
            capitalSucursal: 0
        }
    }, 
    mounted: function(){

    },
    methods: {
        actualizarId_cliente: function (id) {
            this.modelo.id_cliente = id;
            console.log("Se actualizó el ID a " + this.modelo.id_cliente);
        },
        crearPrestamo: function (){
            this.modelo = {
                id_prestamo: 0,
                id_usuario: 0,
                nombreCliente: "",
                monto_prestamo: 0.00,
                saldo: 0.00,
                status: "",
            };
            $('#selectCliente').val(null).trigger('change');
            $('#modalPrestamo').modal('show');
        }
    }
});