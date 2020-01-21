<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <input v-model="alumno.nombre" type="text" name="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <input v-model="alumno.apellidos" type="text" name="apellidos" class="form-control">
                            </div>
                            <div class="form-group">
                                <input v-model="alumno.sexo" type="text" name="sexo" class="form-control">
                            </div>
                            <input type="button" value="Enviar" class="btn btn-block btn-primary mb-2" v-on:click="saveData">
                        </form>
                        <ul v-for="(elemento) in lista" :key="elemento.id">
                            <li v-on:click="editData(elemento)" :class="elemento.sexo">{{ elemento.nombre }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .M {
        background: #0984e3;
    }

    .F {
        background: #fd79a8;
    }
</style>
<script>
    export default {
        props:['data'],
        mounted() {
            this.lista = JSON.parse(this.data);
        },
        data() {
            return {
                lista: null,
                alumno: {
                    nombre: null,
                    apellidos: null,
                    sexo: null
                }
            }
        },
        methods: {
            saveData: function() {
                let self = this;

                axios.post('/data', this.alumno)
                    .then(response => {
                        self.lista.push(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            editData: function(elemento) {
                console.log(elemento)
            }
        }
    }
</script>
