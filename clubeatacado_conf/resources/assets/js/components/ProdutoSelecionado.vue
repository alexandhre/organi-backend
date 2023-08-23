<template>

    <div>
        <section class="section" v-if="produtos === 0" >
            <section class="container has-text-left">
            <div class="container has-content-centered" style="margin-top: -25px">
                <p class="subtitle is-prata is-3 has-text-centered">Nenhum Produto cadastrado</p>
                <figure class="image">
                    <img src="/clubeatacado/css/img/intro_2.png" style="margin: auto;height: auto;width: auto;" alt="Placeholder image">
                </figure>
            </div>
                </section>
        </section>

        <!--------------------------------------PROMOÇÕES--------------->
        <section class="section" v-else>
            <div class="container has-text-left">
                <h2 class="title">PRODUTOS:</h2>
            </div>
            <br> <br>

            <div class="container has-text-left" style="margin-bottom: 4%;">
                <div class="columns is-multiline is-center" style="width: 1200px">
                    <div class="columns is-4" style="width: 25%; margin-left: 1px; height: 87%;" v-for="(item, index) in produtos">
                        <div class="card is-shady" style="width: 260px;">
                            <div class="card" style="cursor:pointer;box-shadow: 0px 0px 3px 0px rgba(10, 10, 10, 0.1), 0 0 1px 0 rgba(10, 10, 10, 0.1);" v-on:click="detailProduto(item.ID_ANUNCIO_PRODUTO)">
                                <div class="card-image">
                                    <figure class="image is-2by1" style="width: auto;">
                                        <img id="imagem" :src="item.DS_FOTO_ANUNCIO" onerror="this.onerror=null;this.src='https://testetendering.myappnow.com.br/clubeatacado/images/photo.png';" style="height: 196px; width: 240px; margin-left: 8px; margin-top: 8px" alt="">
                                    </figure>
                                </div>
                                <div class="card-content" style="margin-left: -5px;margin-top: -20px">
                                    <p class="subtitle is-6 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                    <div class="content">
                                        <font class="subtitle is-6 is-bold">R$ {{item.VL_DESCONTO | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  })}}</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <font class="subtitle is-6 is-danger" v-if="item.VL_DESCONTO !== item.VL_PRODUTO_UNITARIO"><strike>R$ {{item.VL_PRODUTO_UNITARIO | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}</strike></font>
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

</template>

<script>
    export default {
        mounted() {

            var item= localStorage.getItem('busca');
            console.log(item);
                axios.post('/clubeatacado/anuncio/produto/select',{
                    input: item
                }).then(response => {

                    this.produtos =  response.data;
                    console.log(this.produtos);
                })
        },
        data:function(){
            return{
                produtos:[]
            }
        },

        methods:{
            detailProduto: function (id_anuncio) {
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id_anuncio);
                window.open("/clubeatacado/anuncio/produtodetalhe",'_self');
            }
        },
    }
</script>
