
var app = new Vue({
    el: '#app',
    data: { 
        listado: []
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
        }
    }
});