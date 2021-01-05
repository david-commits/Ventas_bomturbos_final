// Creating a new Vue instance and pass in an options object.
var consultaVehiculos = new Vue({
        
        // A DOM element to mount our view model.
        el: '#myModal2',

        // This is the model.
        // Define properties and give them initial values.
        data: {
            //table: new Table(true),
            datos: [],
            editProducto:{ Ns: 1 ,Costo: 0, Ganancia:0, Precio:0, TipoCambio:0 },
            AuxliarTasa: 0
        },

        // Functions we will be using.
        methods: {
                ObtenerTasaDolar: function(){
                	let vm=this;
                    let Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=5';
                	axios.post(Url).then(response=>{
                        vm.AuxliarTasa=parseFloat(response.data[0].dolar);
                            vm.editProducto.TipoCambio=vm.AuxliarTasa;
                		}).catch(function(e){
                		console.log(e)
                	})
                },ObtenerSoles:function(){
                    let vm=this;
                    vm.editProducto.TipoCambio=1;
                    vm.ObtenerNS();
                },ObtenerNS:function(){
                    let vm=this;
                    vm.editProducto.NS=parseFloat(vm.editProducto.Costo) * parseFloat(vm.editProducto.TipoCambio);
                    vm.ObtenerPrecio();
                },ObtenerDolar:function(){
                    let vm=this;
                    vm.editProducto.TipoCambio=vm.AuxliarTasa;
                    vm.ObtenerNS();
                },ObtenerPrecio:function(){
                    let vm=this;
                    vm.editProducto.Precio=parseFloat(vm.editProducto.Ganancia) + parseFloat(vm.editProducto.NS);
                },ActualizarProducto:function(){
                    alert(0);
                }

        },

        mounted(){
           let vm=this;
           vm.ObtenerTasaDolar();
        },
        computed:{
            now() {
                let vm=this;
                vm.editProducto.Precio=parseFloat(vm.editProducto.Ganancia) + parseFloat(vm.editProducto.NS);
                return vm.editProducto.Precio;
            }
        }
});