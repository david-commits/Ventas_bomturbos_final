// Creating a new Vue instance and pass in an options object.
var consultaproductos = new Vue({
        // A DOM element to mount our view model.
        el: '#nuevoCompatible',
        // This is the model.
        // Define properties and give them initial values.
        data: {
                //table: new Table(true),
                datos: [],
                filtroProducto: { marca:"", modelo: "", producto:0},
                Modelos:[],
        },
        // Functions we will be using.
        methods: {
                Buscar: function(){
                	let vm=this;
                        vm.filtroProducto.producto=$("#idProducto").val();
                        var data= vm.toFormData(vm.filtroProducto)

                        var Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=1';
                	axios.post(Url,data).then(response=>{
                			vm.datos=response.data;
                		}).catch(function(e){
                		console.log(e)
                	})
                },
                InactivarCompatible:function(data){
                    let vm=this;
                    var data= vm.toFormData(new Object({ producto: data.id, estado: data.Estado==1?0:1 }))
                    var Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=4';
                    axios.post(Url,data).then(response=>{
                        vm.Buscar();
                    }).catch(function(e){
                        console.log(e)
                    })
                },
                Agregar: ()=>{
                    let vm=this;
                    vm.Buscar();
                },
                ListarModeloUno:function(){
                    let vm=this;
                    vm.filtroProducto.producto=$("#idProducto").val();
                    var data= vm.toFormData(vm.filtroProducto);
                    var Url='Funciones/ConsultarProductos/ConsultarProductos.php?opcion=9';
                    axios.post(Url,data).then(function(response){
                        vm.Modelos=response.data;
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
        },computed:{

            
        },
        mounted(){
           let vm=this;
           //vm.Buscar();
           $(document).ready(function(){
                $('#BtnBuscar').click(function(){
                    vm.Buscar();     
                });
            });
        },
});