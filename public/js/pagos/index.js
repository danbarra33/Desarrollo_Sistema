$(document).ready(function () {
    $.fn.select2.defaults.set('language', 'es');
    $('.select-obj').select2();

    /*$('#selectMetodoPago').select2({
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
    });*/

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
        },
        paginacion: {
            current_page:1,
            first_page_url:"",
            from:0,
            last_page:0,
            last_page_url:"",
            next_page_url:null,
            path:"",
            per_page:0,
            prev_page_url:null,
            to:0,
            total:0,
            per_page:0,
        },
        busqueda: "",
        modoBusqueda: false
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
                        this.listado = response.data.listado.data;
                        this.paginacion = {
                            actual: 1,
                            current_page:response.data.listado.current_page,
                            first_page_url:response.data.listado.first_page_url,
                            from:response.data.listado.from,
                            last_page:response.data.listado.last_page,
                            last_page_url:response.data.listado.last_page_url,
                            next_page_url:response.data.listado.next_page_url,
                            path:response.data.listado.path,
                            per_page:response.data.listado.per_page,
                            prev_page_url:response.data.listado.prev_page_url,
                            to:response.data.listado.to,
                            total:response.data.listado.total,
                            per_page: response.data.listado.per_page,
                        }
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
        },
        search: function(){
            this.modoBusqueda = true;
            var params = "?busqueda="+this.busqueda;
            this.cargarPagos(urlListar+params);
        },
        paginateClick: function (page){
            if(page == null)
                return;

            var buscar="";
            if(this.busqueda == ""){
                this.modoBusqueda = false;
            }
            if(this.modoBusqueda){
                buscar="&busqueda="+this.busqueda;
            }
            this.cargarPagos(urlListar+'?page='+page+buscar);
        },
    }
});


