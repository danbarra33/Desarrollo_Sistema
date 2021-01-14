
var app = new Vue({
    el: '#app',
    data: { 
        listado: [
            {"id_prestamo":1,"id_cliente":23,"nombreCliente":"pedro picapiedra","monto_prestamo":100,"saldo":23,"status":"Vigente"},
            {"id_prestamo":2,"id_cliente":24,"nombreCliente":"pedro picapiedra3","monto_prestamo":500,"saldo":0,"status":"Pagado"},
            {"id_prestamo":3,"id_cliente":25,"nombreCliente":"pedro picapiedra2","monto_prestamo":20,"saldo":100,"status":"Vigente"},
        ],
        index: 0,
        guardando: false,
        cargando: false,
        modelo:{
            id_prestamo: 0,
            id_usuario: 0,
            nombreCliente: "",
            monto_prestamo: 0.00,
            saldo: 0.00,
            status: "",
        }
    }, 
    mounted: function(){
    },
    methods: {
        
        crearPrestamo: function (){
            this.modelo = {
                id_prestamo: 0,
                id_usuario: 0,
                nombreCliente: "",
                monto_prestamo: 0.00,
                saldo: 0.00,
                status: "",
            };
            $('#modalPrestamo').modal('show');
        }
    }
});