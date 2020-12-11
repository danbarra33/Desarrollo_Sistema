
var app = new Vue({
    el: '#app',
    data: { 
        listado: [],
        index: 0,
        guardando: false,
        cargando: false,
        modelo:{
            id: 0,
            name: '',
            address: '',
            phone: '',
            email: '',
            password: '',
            id_sucursal: 0,
            type_of_user: ''
        }
    }, 
    mounted: function(){
        this.cargarEmpleados(urlListado);
    },
    methods: {
        cargarEmpleados: function(url){
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
        crearEmpleado: function (){
            this.modelo = {
                id: 0,
            name: '',
            address: '',
            phone: '',
            email: '',
            password: '',
            id_sucursal: 0,
            type_of_user: ''
            };
            $('#modalEmpleado').modal('show');
        },
        guardarNuevoEmpleado: function (){
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
                    this.listado.push(response.data.empleado);
                    $('#modalEmpleado').modal('hide');
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
            
        }
    }
});