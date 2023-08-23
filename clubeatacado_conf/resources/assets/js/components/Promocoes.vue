
<template>
    <!--------------------------------------PROMOÇÕES--------------->

    <section class="section"  style="background:#fafafa;">
        <div class="container has-text-left">
            <h2 class="title">PROMOÇÕES DA SEMANA</h2>
            <h2 class="subtitle ">Não perca mais tempo, aqui estão as últimas ofertas em promoção.<br>
                Uma excelente oportunidade de economizar!</h2>
        </div>
        <br>

        <div class="container" style="margin-left: 10%">
            <div class="columns is-multiline is-center">

                <div class="column  is-1" style="margin-left: 2%;width: auto;" v-for="(item, index) in this.itensList">
                    <div class="card" style="box-shadow: 0 0px 0px #ffffff00" >
                        <div class="card-image" style="cursor: pointer; background:#fafafa" v-on:click="detailProduto(item.anuncioId)">
                            <figure class="image">
                                <img class="is-rounded" style=" display:initial;     max-height: 100%;
    height: 52px;
    width: 52px;
    border-radius: 50%;" :src="item.foto" >
                            </figure>
                            <p class="subtitle" >{{item.nome}}</p>
                            <div>
                                <p class="subtitle is-danger" style="margin-bottom: 15px;"><strike>R${{ item.preco | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}</strike></p>
                                <p class="subtitle">R${{ item.desconto | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  }) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section has-text-centered">

            <a class="button is-outlined is-danger" id="vermaispromo" style="width: 232px;margin-left: 20px; " v-on:click="loadmore()"> VER MAIS ARTIGOS</a>
        </section>
    </section>
</template>

<script>

    export default {
        props: ['promocoes'],
        mounted() {

            // for (var i = 0; i < this.promocoes.length; i++) {
            //     this.fotos.push(this.promocoes[i].FOTO_ANUNCIO[0]);
            // }
            this.itensList = this.promocoes;
            
        },
        data() {
            return {
                fotos: [],
                item: this.promocoes,
                inicio: 7,
                cont: 0,
                itensList: [],
                

            }
        },
        methods: {
            // ParaPromo: function (id) {
            //     axios.get('/clubeatacado/anuncio/descontos/parar/' + id).then(resp => {
            //         this.anuncios = resp.data.response.anuncio;
            //         console.log(this.anuncios);
            //     });
            // },
            loadmore() {
                //this.promocoes = [];
                $('#vermaispromo').addClass('button is-loading');
                this.cont = this.inicio + this.cont;
               
                axios.get('/clubeatacado/anuncio/MoreAnuncio/' + this.cont).then(res => {
                    $('#vermaispromo').removeClass('button is-loading');
                    $('#vermaispromo').addClass('button is-outlined is-danger');
                    for (var i = 0; i < res.data.length; i++) {
                        this.itensList.push(res.data[i]);

                    }
                    //this.promocoes = this.item;
                    
                });
            },
            detailProduto: function (id_anuncio) {
                this.anuncio = $('#' + id_anuncio).val();
                
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id_anuncio);
                window.open("/clubeatacado/anuncio/produtodetalhe",'_self');
            }
        }
    }
</script>
