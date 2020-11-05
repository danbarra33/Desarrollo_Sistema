
var app = new Vue({
    el: '#app',
    data: { 
        listado: [],
        modelo:{
            id_sucursal: 0,
            nombre_empresa: '',
            capital: 0,
            direccion: ''
        }
    }, 
    mounted: function(){
        this.cargarSucursales(urlListado);
    },
    methods: {
        cargarSucursales: function(url){
            axios.get(url)
            .then(response => {
                if(response.data.codigo == 1){
                    this.listado = response.data.listado;
                }else{                 
                    $.notify({
                        message: response.data.mensaje 
                    },{
                        type: 'danger'
                    });
                }
            })
            .catch(e => {
                console.log(e);
            })
        },
        crearSucursal: function (){
            this.modelo = {
                id_sucursal: 0,
                nombre_empresa: '',
                capital: 0,
                direccion: ''
            };
            $('#modalSucursal').modal('show');
        },
        actualizarSucursal: function (){

        },
        guardarNuevaSucursal: function (){
            axios.get(urlCrear)
            .then(response => {
                if(response.data.codigo == 1){
                    $.notify({
                        message: response.data.mensaje 
                    },{
                        type: 'success'
                    });
                }else{                 
                    $.notify({
                        message: response.data.mensaje 
                    },{
                        type: 'danger'
                    });
                }
                $('#modalSucursal').modal('hide');
            })
            .catch(e => {
                console.log(e);
            })
        },  
        cancelarModal: function (){
            
        },
        editarSucursal: function (){
            
        }
    }
});