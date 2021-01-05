// Creating a new Vue instance and pass in an options object.
var consultaVehiculos = new Vue({
        
        // A DOM element to mount our view model.
        el: '#nuevoVehiculoCompatible',

        // This is the model.
        // Define properties and give them initial values.
        data: {
            //table: new Table(true),
            datos: [],
            filtroProducto: { marca:"", modelo: "",producto: 0 },
            selected:[],
            selectAll: false,
            Modelos: [],
        },

        // Functions we will be using.
        methods: {
                Buscar: function(){
                	let vm=this;
                    vm.filtroProducto.producto=$("#idProducto").val();
                    var data= vm.toFormData(vm.filtroProducto)
                    var Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=2';
                	axios.post(Url,data).then(function(response){
                            vm.datos=response.data;
                		}).catch(function(e){
                		console.log(e)
                	})
                },
                Agregar: function() {
                    let vm = this;
                    const producto = $("#idProducto").val();
                    $.each(vm.selected, function (index, value) {
                        var data = vm.toFormData(value);
                        var Url = 'Funciones/ConsultarProductos/ConsultarProductos.php?opcion=3';
                        var frm = vm.toFormData(new Object({id: value, producto: producto}));
                        axios.post(Url, frm).then(function () {

                        }).catch(function (e) {
                            console.log(e)
                        })
                    });
                    $('#BtnCerrarAgregar').click();
                    $('#BtnBuscar').click();
                    vm.selected = [];
                },

                toFormData:function(obj){
                var fd = new FormData();
                for(var i in obj){
                        fd.append(i,obj[i]);
                }
                return fd;
                },
                ListaModelo: function () {
                    let vm=this;
                    vm.filtroProducto.producto=$("#idProducto").val();
                    var data= vm.toFormData(vm.filtroProducto);
                    var Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=9';
                   axios.post(Url,data).then(function(response){
                        vm.Modelos=response.data;
                    }).catch(function(e){
                        console.log(e)
                    })
                }
        },

        mounted(){
           let vm=this;
           //vm.Buscar();
        },
});