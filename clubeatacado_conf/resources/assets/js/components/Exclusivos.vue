<template>
    <div class="">
        <!--------------------------------------ITENS EXCLUSIVOS--------------->
        <section class="section" style="background: rgb(255, 255, 255);">
            <div class="container has-text-left" v-if="login === 1">
                <h2 class="title">ITENS EXCLUSIVOS PARA VOCÊ</h2>
                <h2 class="subtitle ">Nós separamos os produtos que são tendência<br>
                    no mercado, exclusivamente para você</h2>
            </div>
            <div class="container has-text-left" v-else>
                <h2 class="title">ITENS MAIS PROCURADOS</h2>
                <h2 class="subtitle ">Nós separamos os produtos que são tendência<br>
                    no mercado, exclusivamente para você</h2>
            </div>
            <br>
                <div class="container has-text-left" style="margin-top: 1%;margin-bottom: 5%;">
                    <div class="columns is-multiline is-center"  style="width: 1200px" >
                        <div class="columns is-4" style="width: 25%; height: 25%; margin-left: 1px; margin-top: 1px;"  v-for="(item, index) in anuncio" :key="index">
                            <div class="card" style="cursor: pointer;  box-shadow: rgba(10, 10, 10, 0.1) 0px 0px 3px 0px, rgba(10, 10, 10, 0.1) 0px 0px 1px 0px;" v-on:click="detailProduto(item.anuncioId)">
                                <div class="card-image">
                                    <figure class="image is-2by1">
                                        <img :src="item.foto" style="height: 196px; width: 240px; margin-left: 8px; margin-top: 8px" alt="" onerror="this.onerror=null;this.src='/clubeatacado/images/photo.png';">
                                    </figure>
                                </div>
                                <div class="card-content" style="margin-left: -5px;margin-top: -20px">
                                    <p class="subtitle is-6 is-bold">{{item.nome}}</p>

                                    <p class="subtitle is-6 is-bold">R${{item.desconto  | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}
                                        <font style="margin-left: 45px;" class="subtitle is-6 is-danger" v-if="item.desconto !== item.preco">
                                            <strike>R$ {{item.preco  | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}</strike>
                                        </font>
                                    </p>
                                    <p class="subtitle is-6">{{item.quantidadeMinima}} unids. - Pedido mínimo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                anuncio:[],
                login: 0,
                page: 1,
                items: [],
                item: [],
                cont : 0,
                inicio: 4
            }
        },
        mounted() {
            axios.get('/clubeatacado/anuncio/lista/maisvistos').then(resp =>{

                this.anuncio = resp.data[0];
                this.login = resp.data[1];
                this.items =  this.anuncio;
                console.log(this.items);

            });
            var vm = this;
            window.addEventListener('scroll', function(e){
                var scrollPos = window.scrollY;

                var winHeight = window.innerHeight;
                var docHeight = document.documentElement.scrollHeight;

                if(scrollPos === (docHeight-winHeight)) {

                   // vm.anuncio = [];
                    vm.cont = vm.inicio + vm.cont;
                    axios.get('/clubeatacado/anuncio/maisvisitado/MoreAnuncio/' + vm.cont).then(res => {
                        for (var i = 0; i < res.data[0].length; i++) {
                            vm.anuncio.push(res.data[0][i]);

                        }
                        //vm.anuncio =   vm.item;


                    });
                }

            })
        },
        methods:{
            detailProduto: function (id_anuncio) {
                this.anuncio = $('#' + id_anuncio).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id_anuncio);
                window.open("/clubeatacado/anuncio/produtodetalhe",'_self');
            }
        },


    }
</script>
