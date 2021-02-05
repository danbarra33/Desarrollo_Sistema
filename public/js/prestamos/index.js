
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
        app.cargarCliente(data.id);
    });

    $('#selectPlazo').on('select2:select', function (e) {
        console.log("plazo cambiado")
        app.validar();
    });

});

var app = new Vue({
    el: '#app',
    data: { 
        listado: [],
        index: 0,
        guardando: false,
        cargando: false,
        modelo : {
            valido: false,
            monto: 0,
            pagoQuincenal: 0,
            totalPagar: 0,
            plazo: 3,
            interes: 0,
            estatus: 'V'
        },
        estadoCliente:{
            id_cliente: 0,
            saldo: 0,
            salario: 0,
            historial: "",
            cantidadPrestamos: 1,
            capitalInicialSucursal: 0,
            capitalSucursal: 0
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
        this.cargarPrestamos(urlListado)
    },
    methods: {
        cargarPrestamos: function(url){
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
            this.cargarPrestamos(urlListado+params);
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
            this.cargarPrestamos(urlListado+'?page='+page+buscar);
        },
        cargarCliente: function (id) {
            this.estadoCliente.id_cliente = id;
            this.cargando = true;

            axios.get(urlEstadoCliente+"?id_cliente="+id)
            .then(response => {
                
                this.estadoCliente = {
                    id_cliente: id,
                    saldo: response.data.saldo,
                    salario: response.data.salario,
                    historial: response.data.historial,
                    cantidadPrestamos: response.data.cantidadPrestamos,
                    capitalInicialSucursal: response.data.capitalInicialSucursal,
                    capitalSucursal: response.data.capitalSucursal
                }
                this.cargando = false;
                this.validar();
            })
            .catch(e => {
                console.log(e);
                this.cargando = false; 
            })
        },
        crearPrestamo: function (){
            this.estadoCliente = {
                id_cliente: 0,
                saldo: 0,
                salario: 0,
                historial: "",
                cantidadPrestamos: 1,
                capitalInicialSucursal: 0,
                capitalSucursal: 0
            }
            this.modelo = {
                valido: false,
                monto: 0,
                pagoQuincenal: 0,
                totalPagar: 0,
                plazo: 3,
                interes: 0,
                estatus: 'V'
            };
            $('#selectCliente').val(null).trigger('change');
            $('#modalPrestamo').modal('show');
        },
        validar: function(){


            var cantidadPrestamos = 1
            var clienteMoroso = true
            var monto = Number(parseFloat(this.modelo.monto).toFixed(2))
            var salario = Number(this.estadoCliente.salario)
            var saldo = Number(this.estadoCliente.saldo)
            //3, 6 y 12
            var plazo = parseInt($("#selectPlazo").val())
            var pagar = 0
            var tasaInteres = 0
            var prestable = true
            var maximoPorcentajePrestable = 0
            var pagoQuincenal = 0
            var razonNoPrestamo = ""
            var capitalInicial = parseFloat(this.estadoCliente.capitalInicialSucursal)
            var capitalPrestable = 0
            var capitalSucursal = parseFloat(this.estadoCliente.capitalSucursal)

            capitalPrestable = capitalInicial * 0.2

            this.modelo.pagoQuincenal = 0;
            this.modelo.totalPagar = 0;

            console.log(monto)
   
            if(!(this.estadoCliente.id_cliente > 0)){
                razonNoPrestamo = "Seleccione el cliente."
                prestable = false
            }else if(saldo > 0){
                razonNoPrestamo = "El cliente tiene saldo."
                prestable = false
            }else if(monto <= 0){
                prestable = false
                razonNoPrestamo = "Debe seleccionar un monto válido."
            }else if(monto > 20000){
                prestable = false
                razonNoPrestamo = "El monto máximo son 20,000.00."
            }else if(capitalPrestable < capitalSucursal){
                prestable = false
                razonNoPrestamo = "El capital de la sucursal debe ser mayor al 20%, por favor verifique con su gerente."
            }else if(monto > capitalPrestable){
                prestable = false
                razonNoPrestamo = "Falta capital en la sucursal para este prestamo."
            }
                

            if(clienteMoroso == true){
                maximoPorcentajePrestable = 20
            }else if(cantidadPrestamos + 1 == 1){
                maximoPorcentajePrestable = 30
            }else if(cantidadPrestamos + 1 == 2){
                maximoPorcentajePrestable = 40
            }else if(cantidadPrestamos + 1 == 3){
                maximoPorcentajePrestable = 50
            }else if(cantidadPrestamos + 1 >= 4){
                maximoPorcentajePrestable = 60
            }

            if (monto > salario * (maximoPorcentajePrestable / 100)){
                prestable = false
                razonNoPrestamo = "El cliente " + (cantidadPrestamos == 0 ? 'No tiene' : ('tiene ' + cantidadPrestamos)) + " prestamo" + (cantidadPrestamos  == 1 ? '' : 's') + " y no puede exceder el "+maximoPorcentajePrestable+"% de su salario mensual."
            }

            if(prestable == false){

                $.notify({
                    message: razonNoPrestamo
                }, {
                    type: 'info',
                    z_index: 99999
                });
                this.modelo.valido = false;
                return false;
            }

            if (plazo == 3){
                tasaInteres = 10
            }else if(plazo == 6){
                tasaInteres = 15
            }else if(plazo == 12){
                tasaInteres = 25
            }

            console.log("pazo: "+plazo)
            console.log("tasaInteres: "+tasaInteres)

            this.modelo.totalPagar = ((tasaInteres / 100) * monto) + monto

            this.modelo.pagoQuincenal = this.modelo.totalPagar / (plazo * 2)

            this.modelo.totalPagar = parseFloat(this.modelo.totalPagar).toFixed(2)
            this.modelo.pagoQuincenal = parseFloat(this.modelo.pagoQuincenal).toFixed(2)

            this.modelo.interes = tasaInteres;
            this.modelo.plazo = plazo;

            if(monto > 15000){
                this.modelo.estatus = "S";
            }else{
                this.modelo.estatus = "A";
            }

            this.modelo.valido = true;
            return true;
        },
        guardar: function(){
            this.guardando = true;

            envio = {
                id_cliente: this.estadoCliente.id_cliente,
                monto: this.modelo.monto,
                interes: this.modelo.interes,
                plazo: this.modelo.plazo,
                total: this.modelo.totalPagar,
                quincenal: this.modelo.pagoQuincenal,
                estatus: this.modelo.estatus
            }

            axios.post(urlGuardar, envio)
                .then(response => {
                    if (response.data.codigo == 1) {
                        $.notify({
                            message: response.data.mensaje
                        }, {
                            type: 'success',
                            z_index: 99999
                        });
                        this.search();
                        $('#modalPrestamo').modal('hide');

                    } else {
                        $.notify({
                            message: response.data.mensaje
                        }, {
                            type: 'danger',
                            z_index: 99999
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
});