<template>
    <!--------------------------------------PROMOÇÕES--------------->
    <section class="section">
        <div class="container has-text-left">
            <h2 class="title">PROMOÇÕES</h2>
            <h2 class="subtitle" style="font-weight:normal;">Milhares de artigos em promoção, com super descontos e ofertas<br>
                especiais para os clientes do Clube do Atacado</h2>
        </div>
        <br>

        <div class="container has-text-left">
                <div class="columns is-multiline is-center" style="width: 1200px">
                    <div class="columns is-4" style="width: 25%; height: 25%; margin-left: 1px;" v-for="(item, index) in promocoes">
                        <div class="card is-shady" style="width: 260px;">
                            <div class="card" style="box-shadow: 0px 0px 3px 0px rgba(10, 10, 10, 0.1), 0 0 1px 0 rgba(10, 10, 10, 0.1);" v-on:click="detailProduto(item.ID_ANUNCIO_PRODUTO)">
                                <div class="card-image" style="cursor: pointer">
                                    <figure class="image is-2by1">
                                        <img id="imagem" :src="'/clubeatacado/images/anuncio/'+item.ID_ANUNCIO_PRODUTO+'/'+item.fotos.DS_FOTO_PRODUTO" onerror="this.onerror=null;this.src='/clubeatacado/images/photo.png';" style="height: 196px; width: 240px; margin-left: 8px; margin-top: 8px" alt="Placeholder image">
                                    </figure>
                                </div>
                                <div class="card-content" style="margin-left: -5px;margin-top: -20px">
                                    <p class="subtitle is-6 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                    <p class="subtitle is-6 is-bold">R${{item.VL_DESCONTO}}
                                        <font style="margin-left: 45px;" class="subtitle is-6 is-danger" v-if="item.desconto !== item.VL_PRODUTO_UNITARIO">
                                            <strike>R$ {{item.VL_PRODUTO_UNITARIO  | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}</strike>
                                        </font>
                                    </p>
                                    <p class="subtitle is-6">{{item.QT_MINIMA_PEDIDO }} unids. - Pedido mínimo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</template>

<script>
    export default {
        //props:['promocoes'],
        data(){
            return{
                cont : 0,
                inicio: 12,
                item: this.promocoes,
                promocoes: [],
            }
        },
        mounted() {
            axios.get('/clubeatacado/anuncio/promocoes/more/0').then(resp =>{
                console.log(resp.data);
                this.promocoes = resp.data;

            });

            console.log(this.promocoes);
            //console.log(this.promocoes['0'].fotos['0'].DS_FOTO_PRODUTO);
            var vm = this;
            window.addEventListener('scroll', function(e){
                var scrollPos = window.scrollY;

                var winHeight = window.innerHeight;
                var docHeight = document.documentElement.scrollHeight;

                if(scrollPos === (docHeight-winHeight)) {

                     //vm.promocoes = [];
                    vm.cont = vm.inicio + vm.cont;
                    axios.get('/clubeatacado/anuncio/promocoes/more/' + vm.cont).then(res => {
                        for (var i = 0; i < res.data.length; i++) {
                            //console.log(  res.data[i]);
                             vm.promocoes.push(res.data[i]);

                        }
                       //vm.promocoes =   vm.item;
                         console.log(  vm.promocoes);

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
