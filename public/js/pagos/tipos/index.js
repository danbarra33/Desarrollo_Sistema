

var app = new Vue({
    el: '#app',
    data: {
        hola: "",
        listado:[],
        modelo:{
            id_tipo_pago: 0,
            tipo: '',
            activo: false
        },
        cargando: false,
        guardando: false,
    },
    mounted: function(){
        this.cargar(urlListado);
    },
    methods:{
        cargar: function(url){
            this.cargando = true;
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
                this.cargando = false;
            })
            .catch(e => {
                this.cargando = false;
                console.log(e);
            })
        },
        editar: function(index){
            this.modelo = this.listado[index];
            $('#modalModelo').modal('show');
        },
        crear: function(){
            this.modelo = {
                id_tipo_pago: 0,
                tipo: '',
                activo: true
            };
            $('#modalModelo').modal('show');
        },
        guardarNuevo: function(){
            this.guardando = true; 
            axios.post(urlCrear, this.modelo)
            .then(response => {
                if(response.data.codigo == 1){
                    $.notify({
                        message: response.data.mensaje 
                    },{
                        type: 'info',
                        z_index : 99999
                    });
                    this.cargar(urlListado);
                    $('#modalModelo').modal('hide');
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
        actualizar: function(index){
            this.guardando = true; 
            axios.post(urlActualizar, this.modelo)
            .then(response => {
                if(response.data.codigo == 1){
                    $.notify({
                        message: response.data.mensaje 
                    },{
                        type: 'info',
                        z_index : 99999
                    });
                    this.cargar(urlListado);
                    $('#modalModelo').modal('hide');
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
        borrar: function(index){
            if (window.confirm("¿Borrar?")) {
                this.guardando = true;
                axios.post(urlBorrar, {id_tipo_pago: this.listado[index].id_tipo_pago})
                .then(response => {
                    if(response.data.codigo == 1){
                        $.notify({
                            message: response.data.mensaje 
                        },{
                            type: 'info',
                            z_index : 99999
                        });
                        this.cargar(urlListado);
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
            }
        }
    }
});
