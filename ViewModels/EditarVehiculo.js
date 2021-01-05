// Creating a new Vue instance and pass in an options object.
var EditarVehiculos = new Vue({
        
        // A DOM element to mount our view model.
        el: '#myModalVehiculo',

        // This is the model.
        // Define properties and give them initial values.
        data: {
            //table: new Table(true),
            datos: [],
            dataVehiculo: { idMarca: 0 ,Modelo: 0,Nombre:'',Motor:'',Cilindro:'',Anio:0,Combustible:'',Detalle:'', Estado:0, id: 0},
            Modelos: []
        },

        // Functions we will be using.
        methods: {
                ListarModeloByMarca: function(){
                    let vm=this;
                    var data= vm.toFormData(vm.dataVehiculo);
	                var Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=6';
	            	axios.post(Url,data).then(function(response){
                        vm.Modelos=response.data;
                        vm.dataVehiculo.modelo=vm.Modelos[0].id;
	            		}).catch(function(e){
	            		console.log(e)
	            	})
			
                },ActualizarVehiculo:function(){
                    let vm=this;
                    vm.dataVehiculo.id=$("#idVehiculoA").val();
                    var data= vm.toFormData(vm.dataVehiculo);
                        var Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=7';
                        axios.post(Url,data).then(function(R){
                            alert('Bien');
                        }).catch(function(e){
                        console.log(e)
                    })
                },DataModal:function(){
                    let vm=this;
                    vm.dataVehiculo.id=$("#idVehiculoA").val();
                    var data= vm.toFormData(vm.dataVehiculo);
                        var Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=8';
                        axios.post(Url,data).then(function(response){
                            vm.dataVehiculo.idMarca=response.data.idMarca;
                            vm.dataVehiculo.Modelo=response.data.Modelo;
                            vm.dataVehiculo.Nombre=response.data.Nombre;
                            vm.dataVehiculo.Motor=response.data.Motor;
                            vm.dataVehiculo.Cilindro=response.data.Cilindro;
                            vm.dataVehiculo.Anio=response.data.Anio;
                            vm.dataVehiculo.Combustible=response.data.Combustible;
                            vm.dataVehiculo.Detalle=response.data.Detalle;
                            vm.dataVehiculo.Estado=response.data.Estado;
                            vm.dataVehiculo.id=response.data.id;
                            console.log(vm.dataVehiculo);
                        }).catch(function(e){
                        console.log(e)
                    })
                },

                toFormData:function(obj){
                var fd = new FormData();
                for(var i in obj){
                        fd.append(i,obj[i]);
                }
                return fd;
                }
        },

        mounted(){
           let vm=this;
           $('.EV').click(function(){
            alert(0);
                setTimeout(function(){
                    vm.DataModal();
                },1000);
           });
           //vm.Buscar();
        },
        computed:{
            observador:function(){
                 let vm=this;
                 setTimeout(function(){
                    vm.ListarModeloByMarca();
                 },1000);
                 return vm.dataVehiculo.idMarca>0;
            }
        }
});
