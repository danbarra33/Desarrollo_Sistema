
var app = new Vue({
    el: '#app',
    data: { 
        listado: [],
        index: 0,
        guardando: false,
        cargando: false,
        modelo:{
            id_prestamo: 0,
            id_sucursal: 0,
            id_cliente: 'Proff',
            id_usuario: 0,
            fecha_prestamo: '',
            monto_prestamo: 0,
            interes_prestamo: 0,
            saldo: 0,
            plazo: '',
            status:''
        }
    }, 
    mounted: function(){
    },
methods: {
        
        crearPrestamo: function (){
            this.modelo = {
                id_prestamo: 0,
                id_sucursal: 0,
                id_cliente: 0,
                id_usuario: 0,
                fecha_prestamo: '',
                monto_prestamo: 0,
                interes_prestamo: 0,
                saldo: 0,
                plazo: '',
                status:''
            };
            $('#modalPrestamo').modal('show');
        }
    }
});