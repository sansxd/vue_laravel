<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categorías
                        <button @click="abrirModal('categoria','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arreglo_categoria" :key="categoria.id">
                                    <td>
                                        <button type="button" @click="abrirModal('categoria','actualizar',categoria)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="categoria.nombre">Equipos</td>
                                    <td v-text="categoria.descripcion">Dispositivos electrónicos</td>
                                    <td v-if="categoria.condicion">
                                        <span class="badge badge-success">Activo</span>
                                    </td>
                                    <td v-else>
                                        <span class="badge badge-danger">Inactivo</span>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">Ant</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="titulo_modal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" name="nombre" class="form-control" placeholder="Nombre de categoría">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="descripcion" name="descripcion" class="form-control" placeholder="Ingrese Descripcion">
                                    </div>
                                </div>
                                <div v-show="error_categoria" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in error_arreglo_msn" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipo_accion==1" class="btn btn-primary" @click="registrarCategoria()">Guardar</button>
                            <button type="button" v-if="tipo_accion==2" class="btn btn-primary" @click="actualizarCategoria()" >Actualizar</button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
        </main>
</template>

<script>
    export default {
        mounted() {
            console.log('comp montado.')
            this.listarCategoria(); 
        },
        data() {
            return {
                nombre:'',
                descripcion:'',
                arreglo_categoria:[],
                modal: false,
                titulo_modal :'',
                tipo_accion : 0,
                error_categoria : false,
                error_arreglo_msn :[],
                categoria_id : 0
            }
        },
        methods: {
            listarCategoria() {
                let este = this;
                axios.get('/categoria').then(function (response) {
                    // handle success
                    //console.log(response)
                    este.arreglo_categoria = response.data
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                
            },
            registrarCategoria(){
                if (this.validarCategoria()) {
                    return;
                }
                let me = this;
                axios.post('/categoria/registrar', {
                    'nombre' : this.nombre,
                    'descripcion' : this.descripcion
                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria();
                    
                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            actualizarCategoria(){
                if (this.validarCategoria()) {
                    return;
                }
                let me = this;
                axios.put('/categoria/actualizar', {
                    'nombre' : this.nombre,
                    'descripcion' : this.descripcion,
                    'id' : this.categoria_id
                })
                .then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria();
                    
                    
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            abrirModal(modelo, accion, data = []){
                switch (modelo) {
                    case "categoria":
                    {
                        switch (accion) {
                            case 'registrar':
                                {
                                    this.modal = true;
                                    this.titulo_modal = 'Registrar Categoria';
                                    this.nombre = '';
                                    this.descripcion = '';
                                    this.tipo_accion = 1
                                    break;
                                }
                            case 'actualizar':
                                {   
                                    this.modal = true;
                                    this.titulo_modal = 'Actualizar Categoria';
                                    this.tipo_accion = 2;
                                    this.nombre = data['nombre'];
                                    this.descripcion = data['descripcion'];
                                    this.categoria_id = data['id'];
                                    break;
                                }
                            
                        }
                    }
                        
                    break;
                
                    default:
                        break;
                }
            },
            cerrarModal(){
                this.modal = false;
                this.titulo_modal = '';
                this.nombre = '';
                this.descripcion ='';
            },
            validarCategoria(){
                this.error_categoria = false
                this.error_arreglo_msn = []
                if (!this.nombre) {
                    this.error_arreglo_msn.push("El nombre de la categoria no puede estar vacio")
                }
                if (this.error_arreglo_msn.length) this.error_categoria = true;
                return this.error_categoria; 
            }
        },
        
    }
</script>
<style>
.modal-content{
    width: 100% !important;
    position: absolute !important;
}
.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #3c29297a !important;
}
.div-error{
    display: flex;
    justify-content: center;
}
.text-error{
    color: red !important;
    font-weight: bold;
}
</style>