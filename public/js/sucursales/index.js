
var app = new Vue({
    el: '#app',
    data: { 
        listado: [],
        index: 0,
        guardando: false,
        cargando: false,
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
            this.guardando = true;
            axios.post(urlActualizar, this.modelo)
            .then(response => {
                if(response.data.codigo == 1){
                    $.notify({
                        message: response.data.mensaje
                    },{
                        type: 'success',
                        z_index : 99999
                    });
                    this.listado[this.index] = response.data.sucursal;
                    $('#modalSucursal').modal('hide');
                    
                }else{                 
                    $.notify({
                        message: response.data.mensaje
                    },{
                        type: 'danger',
                        z_index : 99999
                    });
                }
                this.guardando = false;           
            })
            .catch(e => {
                console.log(e);
                this.guardando = false;
            })
        },
        guardarNuevaSucursal: function (){
            this.guardando = true; 
            axios.post(urlCrear, this.modelo)
            .then(response => {
                if(response.data.codigo == 1){
                    $.notify({
                        message: response.data.mensaje 
                    },{
                        type: 'success',
                        z_index : 99999
                    });
                    this.listado.push(response.data.sucursal);
                    $('#modalSucursal').modal('hide');
                }else{                 
                    $.notify({
                        message: response.data.mensaje 
                    },{
                        type: 'danger',
                        z_index : 99999
                    });
                }
                this.guardando = false;   
            })
            .catch(e => {
                console.log(e);
                this.guardando = false; 
            })
        },  
        cancelarModal: function (){
            
        },
        editarSucursal: function (index){
            this.modelo = {
                id_sucursal: this.listado[index].id_sucursal,
                nombre_empresa: this.listado[index].nombre_empresa,
                capital: this.listado[index].capital,
                direccion: this.listado[index].direccion
            };
            
            this.index = index;
            $('#modalSucursal').modal('show');
        }
    }
});