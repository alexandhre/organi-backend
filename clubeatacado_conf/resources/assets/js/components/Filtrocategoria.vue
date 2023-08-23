<template>

    <section class="section">
        <div class="container has-text-left" >
            <nav class="level" id="filtoButtom" style="display: -webkit-box;">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item" style="height: 48px;width: 212px">
                        <a class="button is-medium is-outlined" style="font-size: 16px; padding: 20px; color: #525763; background-color: white;
        border-color: #525763;" v-on:click="showFilter()">
            <span class="icon is-medium" style="color: #525763;">
                             <i class="fas fa-sliders-h"></i>
                        </span>&nbsp&nbsp
                            Filtrar resultados</a>
                    </div>
                </div>

                <!-- Right side -->
                <div class="level-right">
                    <div class="tabs is-centered" style="border-bottom-color:#ffffff">
                        <ul style="border-bottom-color:#ffffff">
                            <li>Ordenar por:&nbsp </li>

                            <div class="select">

                                <select class="is-focused" style="border-color:#ffffff00;color:#23A7FB">
                                    <option  value="lowestPrice"> menor preço</option>
                                    <option value="highestPrice"> maior preço</option>
                                    <option value="betterRated"> melhor avaliado</option>
                                </select>
                            </div>
                        </ul>
                    </div>

                </div>
            </nav>


            <div class="container has-text-left" id="filto" style="display: none;">
                <p class="container has-text-left" style="font-size: 18px; color: #23A7FB; padding-left: 0px;">Filtros</p>
                <br>
                <div class="columns">
                    <div class="column">
                        <p class="subtitle is-6">Cor</p>
                        <div class="card" style="background-color: #E8EBF0;">
                            <div class="select">
                                <select class="is-focused" style="width: 321px;background-color: #E8EBF0;border-color:#ffffff00;">
                                    <option v-for="(item, index) in cores"
                                            :value="item.ID_COR"
                                    >
                                        {{item.DS_COR}}
                                    </option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="column" style="padding-left: 68px;">
                        <p class="subtitle is-6">Material</p>
                        <div class="card" style="background-color: #E8EBF0;">
                            <div class="select">
                                <select class="is-focused" style="width: 321px;background-color: #E8EBF0;border-color:#ffffff00;">
                                    <option>Escolha o material</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="column" style="padding-left: 30px; margin-block-start: -25px;" >
                        <a v-on:click="backFilter()">
                            <i class="fas fa-times" style="margin-left: 321px" ></i>
                        </a>

                        <p class="subtitle is-6">Preço</p>
                        <div class="">
                            <div class="range">
                                <span style="" v-text="'R$ '+total"></span>
                                <span style="margin-left: 32%;" v-text="'+R$ '+total2" ></span><br/>
                                <div class="columns is-multiline is-center" style="width: 1400px; margin-top:15px">
                                    <div class="columns is-2" style="width: 25%; margin-left: 1px;">
                                        <input type="range" min="0" max="500" step="1" v-model="value">
                                        <input type="range" min="500" max="1000" step="1" v-model="value2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="section has-text-centered" style="margin-left: 670px; width: 500px;">
                    <div class="buttons has-addons is-right">
                        <span class="button is-medium is-outlined is-link" style="width: 212px;margin-right: 25px">Limpar filtro</span>
                        <span class="button is-medium" style="color: #ffffff;width: 212px">Aplicar filtro</span>
                    </div>
                </section>
            </div>

        </div>
    </section>

</template>

<script>
    export default {
        props:['cores'],
        mounted(){
            console.log(this.cores)
        },
        data() {
            return {
                value: 0,
                value2: 1000,
                sortBy: null
            }
        },
        computed: {
            total: function () {
                return this.value
            },
            total2: function () {
                return this.value2
            },
            filterProduct: function () {
                return this.itensList.filter(res => {
                    console.log(res);
                    return (this.search.length === 0 || res.DS_TITULO_ANUNCIO.toLowerCase().includes(this.search.toLowerCase()))

                }).sort((a, b) => {
                    if (this.sortBy === 'lowestPrice') {
                        return a.VL_ANUNCIO - b.VL_ANUNCIO;

                    } else if (this.sortBy === 'highestPrice') {
                        return b.VL_ANUNCIO - a.VL_ANUNCIO;
                    } else if (this.sortBy === 'betterRated') {
                        return b.VL_AVALIACAO_USUARIO_ANUNCIO - a.VL_AVALIACAO_USUARIO_ANUNCIO;
                    } else if (this.sortBy === 'byMorning') {
                        for (let k = 0; k < a.hora.length; k++) {
                            if (a.hora[k].IN_MANHA === '1' && b.hora[k].IN_MANHA === '1') {
                                return a.hora[k].IN_MANHA && b.hora[k].IN_MANHA;
                            }
                        }

                    } else if (this.sortBy === 'byAfternoon') {
                        for (let k = 0; k < a.hora.length; k++) {
                            if (a.hora[k].IN_TARDE === '1' && b.hora[k].IN_TARDE === '1') {
                                return a.hora[k].IN_TARDE && b.hora[k].IN_TARDE;
                            }
                        }

                    }
                })

            }
        },
        methods:{
            showFilter: function(){
                $('#filtoButtom').css('display', 'none');
                $('#filto').css('display', 'block');
            },
            backFilter: function(){
                $('#filto').css('display', 'none');
                $('#filtoButtom').css('display', '-webkit-box');
            }
        }
    };
</script>
