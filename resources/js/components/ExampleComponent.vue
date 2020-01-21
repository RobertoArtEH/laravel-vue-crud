<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <ul v-for="(element) in lista" :key="element.id">
                            <li :class="element.sexo">{{ element.nombre }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .M {
        background: blue;
    }

    .F {
        background: pink;
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
                lista: null
            }    
        }
    }
</script>
