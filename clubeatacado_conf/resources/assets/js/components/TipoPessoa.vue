<template>
    <section>
        <div class="buttons has-addons is-centered" style="margin-bottom: 15px">
            <div class="columns checkbox-verde is-mobile" style="width: 300px;">
                <div class="column is-6 is-pulled-left  is-paddingless">
                    <input type="radio" name="checkbox-option" id="checkbox-button-opt-one" class="hide-checkbox button-red" value="1">
                    <label for="checkbox-button-opt-one" v-on:click="checked">Pessoa Física</label>
                </div>
                <div class="column is-6 is-pulled-left  is-paddingless">
                    <input type="radio" name="checkbox-option" id="checkbox-button-opt-two" class="hide-checkbox" value="2">
                    <label for="checkbox-button-opt-two" v-on:click="checked2">Pessoa Jurídica</label>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        },
        methods: {
            checked: function () {
                this.perfil_id = $('#checkbox-button-opt-one').val();

                console.log(this.perfil_id);

                this.perfil_id = localStorage.setItem('id_perfil', '1');

            },

            checked2: function () {
                console.log($('#checkbox-button-opt-two').val());
                this.perfil_id = localStorage.setItem('id_perfil', '2');

            },

        }

    }
</script>
