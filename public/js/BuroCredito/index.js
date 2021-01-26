var app = new Vue({
    el: '#app',
    data: { 
        listado: [],
        index: 0,
        guardando: false,
        cargando: false,
        modelo:{
            id_cliente: 0,
            fecha_ingreso: '',
            saldodeudor: 0,
            status: '',
            
        }
    }, 
    mounted: function(){
        this.cargarburo(urlListado);
    },
    methods: {
        cargarburo: function(url){
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
        }
    }
});