<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-center">Async Form - Vue</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form>
                                    <div class="form-group">
                                        <label for="nombre">Nombres</label>
                                        <input v-model="alumno.nombre" type="text" name="nombre" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input v-model="alumno.apellidos" type="text" name="apellidos" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="sexo">Sexo (M/F)</label>
                                        <input v-model="alumno.sexo" type="text" name="sexo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="edad">Edad</label>
                                        <input v-model="alumno.edad" type="number" name="edad" class="form-control">
                                    </div>
                                    <input 
                                        type="button" 
                                        value="Enviar" 
                                        class="btn btn-block btn-success mb-2" 
                                        v-if="this.isEdit == false" 
                                        v-on:click="saveData">
                                    <input 
                                        type="button" 
                                        value="Editar" 
                                        class="btn btn-block btn-info text-light mb-2" 
                                        v-on:click="updateTable"
                                        v-else>
                                </form>
                            </div>
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(el, idx) in list" :key="el.id">
                                            <th v-on:click="editData(el, el.id)" :class="el.sexo">
                                                {{ el.nombre }}
                                            </th>
                                            <th v-on:click="editData(el, el.id)" :class="el.sexo">
                                                {{ el.apellidos }}
                                            </th>
                                            <th v-on:click="deleteData(el, idx)" :class="el.sexo">
                                                <input class="btn btn-danger" type="button" value="Borrar">
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .M {
        background: #0984e3;
        color: #fff;
    }

    .F {
        background: #fd79a8;
        color: #fff;
    }
</style>
<script>
    export default {
        props:['data'],
        mounted() {
            this.list = JSON.parse(this.data);
        },
        data() {
            return {
                list: null,
                isEdit: false,
                alumno: {
                    id: null,
                    nombre: null,
                    apellidos: null,
                    sexo: null,
                    edad: null
                }
            }
        },
        methods: {
            cleanInput: function() {
                this.alumno.nombre = '';
                this.alumno.apellidos = '';
                this.alumno.sexo = '';
                this.alumno.edad = '';
            },
            saveData: function() {
                let self = this;

                axios.post('/data', this.alumno)
                    .then(response => {
                        console.log(response);
                        self.list.push(response.data);
                        self.cleanInput();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            editData: function(el, idx) {
                this.alumno.id = idx;
                this.alumno.nombre = el.nombre;
                this.alumno.apellidos = el.apellidos;
                this.alumno.sexo = el.sexo;
                this.alumno.edad = el.edad;
                this.isEdit = true;
            },
            updateTable: function() {
                let id = this.alumno.id;

                for (let i = 0; i < this.list.length; i++) {
                    console.log(this.list[i]);
                    console.log(this.list[i].id == this.alumno.id);

                    if (this.list[i].id == this.alumno.id) {
                        this.list[i].nombre = this.alumno.nombre;
                        this.list[i].apellidos = this.alumno.apellidos;
                        this.list[i].sexo = this.alumno.sexo;
                        this.list[i].edad = this.alumno.edad;
        
                        this.updateData(id)
                    }
                }
            },
            deleteData: function(el, idx) {
                axios.delete(`/dataDelete/${el.id}`, this.alumno)
                    .then(response=> {
                        console.log(response);
                        this.list.splice(idx, 1);
                        this.cleanInput();
                        this.isEdit = false;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            updateData: function(idx) {
                axios.put(`/dataUpdate/${idx}`, this.alumno)
                    .then(response=> {
                        console.log(response);
                        this.cleanInput();
                        this.isEdit = false;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>
