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
                                        <label for="nombre">Sexo (M/F)</label>
                                        <input v-model="alumno.sexo" type="text" name="sexo" class="form-control">
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
                                            <th v-on:click="editData(el, idx)" :class="el.sexo">
                                                {{ el.nombre }}
                                            </th>
                                            <th v-on:click="editData(el, idx)" :class="el.sexo">
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
                    sexo: null
                }
            }
        },
        methods: {
            cleanInput: function() {
                this.alumno.nombre = '';
                this.alumno.apellidos = '';
                this.alumno.sexo = '';
            },
            saveData: function() {
                let self = this;

                axios.post('/data', this.alumno)
                    .then(response => {
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
                this.isEdit = true;
            },
            updateTable: function() {
                let id = this.alumno.id;

                this.list[id].nombre = this.alumno.nombre;
                this.list[id].apellidos = this.alumno.apellidos;
                this.list[id].sexo = this.alumno.sexo;

                this.updateData()
            },
            deleteData: function(el, idx) {
                this.list.splice(idx, 1);
                this.cleanInput();
                this.isEdit = false;
            },
            updateData: function() {
                axios.post(`/data`, { alumno: this.alumno})
                    .then(response=> {
                        this.cleanInput();
                        this.isEdit = false;
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    }
</script>
