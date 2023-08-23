<template>
    <div>
    <div v-if="this.categorias.length > 0" >
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
                                <li>Ordenar por: &nbsp </li>

                                <div class="select">

                                    <select class="is-focused" style="border-color:#ffffff00;color:#23A7FB"  v-model="sortBy">
                                        <option  value="highestPrice"> maior preço</option>
                                        <option value="lowestPrice"> menor preço</option>
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
                                    <select class="is-focused" style="width: 321px;background-color: #E8EBF0;border: none;" v-model="cor">
                                        <option style="border: none;">Escolha a cor</option>
                                        <option v-for="(item, index) in cores" v-bind:value="item.DS_CODIGO" :key=index
                                                style="border: none;">
                                            {{item.DS_COR}}
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <p> | </P>
                        <div class="column" style="padding-left: 68px;">
                            <p class="subtitle is-6">Subcategorias</p>
                            <div class="card" style="background-color: #E8EBF0;">
                                <div class="select">
                                    <select class="is-focused" style="width: 321px;background-color: #E8EBF0;border: none;" v-model="subcat">
                                        <option style="border: none;">Escolha a subcategoria</option>
                                        <option v-for="(item, index) in sub" v-bind:value="item.ID_CATEGORIA_PRODUTO" :key=index>
                                            {{item.DS_CATEGORIA_PRODUTO}}
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <p> | </P>
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
                                            <input type="range" min="0" :max="(this.categorias['0'].VL_PRODUTO_UNITARIO)/2" step="1" v-model="value">
                                            <input type="range" min="0" :max="this.categorias['0'].VL_PRODUTO_UNITARIO" step="1" v-model="value2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="section has-text-centered" style="margin-left: 670px; width: 500px;">
                        <div class="buttons has-addons is-right">
                            <span class="button is-medium is-outlined is-link" style="width: 212px;margin-right: 25px" v-on:click="clearFilter()">Limpar filtro</span>
                            <span class="button is-medium" style="color: #ffffff;width: 212px"  v-on:click="selectedList()">Aplicar filtro</span>
                        </div>
                    </section>
                </div>

            </div>
        </section>

        <section class="section">
            <div class="container has-text-left" >
                <div class="columns is-multiline is-center" style="width: 107%">
                    <div class="columns is-4" style="height: 87%; margin-left: 1%;" v-for="(item, index) in filterProduct" :key=index>
                        <div class="card is-shady" style="width: 260px;">
                            <div class="card" style="cursor: pointer;  box-shadow: rgba(10, 10, 10, 0.1) 0px 0px 3px 0px, rgba(10, 10, 10, 0.1) 0px 0px 1px 0px;" v-on:click="detailProduto(item.ID_ANUNCIO_PRODUTO)">
                                <div class="card-image" >
                                    <figure class="image is-2by1" style="width: 100%">
                                        <img :src="item.FOTO_ANUNCIO" onerror="this.onerror=null;this.src='/clubeatacado/images/photo.png';" style="height: 196px;
    width: 240px;margin-left: 8px; margin-top: 8px;" alt="Placeholder image">
                                    </figure>
                                </div>
                                <div class="card-content" style="margin-left: -5px; margin-top: -20px;">
                                    <div class="media-content">
                                        <p class="subtitle is-6 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                    </div><br>
                                    <div class="content">
                                        <font class="subtitle is-6 is-bold"></font>R${{item.VL_PRODUTO_UNITARIO - item.VL_DESCONTO}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <font class="subtitle is-6 is-danger" v-if="item.VL_DESCONTO"><strike>R${{item.VL_PRODUTO_UNITARIO}}</strike></font>
                                        <br><br><p class="subtitle is-6">{{item.QT_MINIMA_PEDIDO}} unids. - Pedido mínimo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        <div class="columns is-centered" style="margin-top: 8%; margin-bottom: 6%" v-else>
            <div class="column" style="padding-left:260px">
                <p class="subtitle is-prata is-3 " style="margin-left: 20%;">Esta categoria ainda não possui nenhum produto</p>
                <!--<h2 style="width: fit-content;color: #d73c38;">Você nao possui nenhum chat</h2>-->

                <figure style="margin-left: 27%; margin-top: 5%">
                    <img class="image is-2by3" style="width: auto; height: auto" src="/clubeatacado/css/img/intro_2.png" alt="ilu_1">
                </figure>
            </div>
        </div>
    </div>
</template>

<script>
    /*Other component*/
    import Vue from 'vue'
    import filtrocategoria from './Filtrocategoria.vue'

    Vue.component('Filtrocategoria', filtrocategoria);
    export default {
        props:['categorias', 'cores','sub'],
        data() {
            return {
                urlpath: window.location.pathname,
                value: 0,
                value2: 0,
                sortBy: 'highestPrice',
                itensList: [],
                colors: [],
                cor: 'Escolha a cor',
                subcat: 'Escolha a subcategoria',
                search:'',
                cont : 0,
                inicio: 4,
                max:0
            }
        },
        created(){
            this.itensList = this.categorias;
            console.log(this.itensList);
            this.value2 = this.categorias['0'].VL_PRODUTO_UNITARIO

        },
        mounted() {
            for(let i=0; i < this.cores.length; i++){
                this.colors.push(this.cores[i].DS_COR);
            }
            console.log(this.cores);

            var type = this.urlpath.split("/");

            var vm = this;
            window.addEventListener('scroll', function(e){
                var scrollPos = window.scrollY;

                var winHeight = window.innerHeight;
                var docHeight = document.documentElement.scrollHeight;

                if(scrollPos === (docHeight-winHeight)) {

                    // vm.anuncio = [];
                    vm.cont = vm.inicio + vm.cont;
                    axios.get('/clubeatacado/categoria/tipo/Eletrônicos/' + vm.cont).then(res => {
                        //console.log(res.data);
                        // for (var i = 0; i < res.data.length; i++) {

                        //     vm.itensList.push(res.data[i]);

                        // }
                        //vm.anuncio =   vm.item;
                        //console.log(  vm.itensList);

                    });
                }

            })

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

                    return (this.search.length === 0 || res.DS_ANUNCIO_PRODUTO.toLowerCase().includes(this.search.toLowerCase()))

                }).sort((a, b) => {
                    if (this.sortBy === 'highestPrice') {
                        return (b.VL_PRODUTO_UNITARIO - b.VL_DESCONTO) - (a.VL_PRODUTO_UNITARIO - b.VL_DESCONTO);


                    } else if (this.sortBy === 'lowestPrice') {
                        return (a.VL_PRODUTO_UNITARIO - b.VL_DESCONTO) - (b.VL_PRODUTO_UNITARIO - b.VL_DESCONTO);

                    } else if (this.sortBy === 'betterRated') {
                        return b.VL_AVALIACAO_USUARIO_ANUNCIO - a.VL_AVALIACAO_USUARIO_ANUNCIO;
                    }
                })

            },

        },
        methods:{
            showFilter: function(){
                $('#filtoButtom').css('display', 'none');
                $('#filto').css('display', 'block');
            },
            backFilter: function(){
                $('#filto').css('display', 'none');
                $('#filtoButtom').css('display', '-webkit-box');
            },
            selectedList: function() {

                this.itensList = [];

                for(var i =0; i < this.categorias.length; i++) {

                    if ((this.categorias[i].VL_PRODUTO_UNITARIO - this.categorias[i].VL_DESCONTO) >= this.value && (this.categorias[i].VL_PRODUTO_UNITARIO - this.categorias[i].VL_DESCONTO) <= this.value2) {


                        if('ESCOLHA A COR' !== this.cor.toUpperCase() && 'ESCOLHA A SUBCATEGORIA' !== this.subcat.toUpperCase()){
                            var item =  [];
                            if(this.categorias[i].ID_CATEGORIA_PRODUTO === this.subcat){
                                item.push(this.categorias[i]);
                            }

                            for(var x =0; x < item.length; x++) {
                                for(var j =0; j < item[x].CORES.length; j++) {
                                    if (item[x].CORES[j].DS_COR === this.cor.toUpperCase()) {
                                        console.log(this.categorias[i]);
                                        this.itensList.push(this.categorias[i]);
                                    }
                                }
                            }
                        }




                        if('ESCOLHA A COR' !== this.cor.toUpperCase() && 'ESCOLHA A SUBCATEGORIA' === this.subcat.toUpperCase()){
                            for(var j =0; j < this.categorias[i].CORES.length; j++) {
                                if (this.categorias[i].CORES[j].DS_COR === this.cor.toUpperCase()) {
                                   // console.log(this.categorias[i]);
                                    this.itensList.push(this.categorias[i]);
                                }
                            }
                        }

                        if('ESCOLHA A SUBCATEGORIA' !== this.subcat.toUpperCase() && 'ESCOLHA A COR' === this.cor.toUpperCase()){

                                if(this.categorias[i].ID_CATEGORIA_PRODUTO === this.subcat){
                                    this.itensList.push(this.categorias[i]);
                                }

                        }
                        if('ESCOLHA A COR' === this.cor.toUpperCase() && 'ESCOLHA A SUBCATEGORIA' === this.subcat.toUpperCase()){
                            this.itensList.push(this.categorias[i]);

                        }
                    }
                }


                return this.itensList;
            },
            clearFilter: function() {
                    this.itensList = this.categorias;
            },
            detailProduto: function (id_anuncio) {
                this.anuncio = $('#' + id_anuncio).val();
                //console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id_anuncio);
                window.open("/clubeatacado/anuncio/produtodetalhe",'_self');
            }
        }
    }
</script>
