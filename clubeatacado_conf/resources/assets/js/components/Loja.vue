<template>
    <section class="section">

        <div class="container has-text-centered">
            <div class="columns">
                <div class="column" id="produtos" style="display: block">
                    <div class="box musica" v-for="item in itensList">
                        <table class="title is-6" style="position:relative;left:650px;top:25px;font-family:Arial">
                            <td>00:00&nbsp</td>
                            <td>/&nbsp</td>
                            <td>2:34&nbsp</td>
                        </table>
                        <p class="title is-6 is-bold has-text-left" style="margin-left:10px;font-family:Arial">
                            {{item.DS_TITULO}}</p>
                        <article class="media" style="background:#fafafa">
                            <div class="media-left">
                                <figure>
                                    <img style="height: 86px;width: 86px;"
                                         src="https://res.cloudinary.com/teepublic/image/private/s--wF5SWCfU--/t_Preview/b_rgb:191919,c_limit,f_jpg,h_630,q_90,w_630/v1499841735/production/designs/1732096_1.jpg"
                                         alt="Image"/>
                                    <img style="padding-left: 10px;padding-bottom: 20px;" src="/clubeatacado/css\img\play-amarelo.png"
                                         id="play">
                                </figure>
                            </div>
                        </article>

                        <div class="content">
                            <a v-bind:id="item.ID_COMPOSICAO"
                               v-on:click="changeFollow(item.ID_COMPOSICAO,item.DS_TITULO,total)"
                               class="button is-link is-medium is-rounded"
                               style="position:relative; left:230px; top:30px"><img src="/clubeatacado/css\img\carrinho.png"> &nbsp Adicionar ao carrinho</a>
                            <p class="subtitle is-warning has-text-left" style="margin-left:10px;">R$ {{valor}}</p>

                        </div>
                    </div>

                </div>


                <div id="compra" class="container has-text-centered" style="font-family:Arial; display:none">
                    <div class="columns is-centered">
                        <div class="column is-five-fifths">

                            <div class="card"
                                 style="box-shadow: 0px 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);border: 1px solid rgba(10, 10, 10, 0.1);border-top: 0px solid transparent;">
                                <div class="card-content">
                                    <div class="content has-text-left">

                                        <div class="box" style="width:400px; position:relative; left:150px">
                                            <article class="media">
                                                <div class="control">
                                                    <label class="radio">
                                                        <input type="radio" name="resposta">
                                                        <b class="subtitle" style="padding-left:12px">Pago con
                                                            tarjeta<img src="/clubeatacado/css\img\cartao.png"
                                                                        style="position:relative; left:10px; top:7px"></b>
                                                    </label>
                                                    <hr class="dropdown-divider"
                                                        style="width: 400px; margin-left: -20px;">
                                                    <p class="subtitle is-prata" style=" font-weight:normal"> Los pagos
                                                        con tarjeta están encriptados y peotegidos con los últimos
                                                        estándares de seguridad.</p>
                                                </div>
                                            </article>
                                        </div>
                                        <br>
                                        <div class="box" style="width:400px; position:relative; left:150px">
                                            <article class="media">
                                                <div class="control">
                                                    <label class="radio">
                                                        <input type="radio" name="resposta">
                                                        <b class="subtitle" style="padding-left:12px">Tranferencia
                                                            bancaria</b>
                                                    </label>
                                                    <span class="icon is-small">
		<i class="fas fa-lock" style="position: absolute;left: 330px;"></i>
		</span>

                                                </div>
                                            </article>
                                        </div>
                                        <br>
                                        <div class="box" style="width:400px; position:relative; left:150px">
                                            <article class="media">
                                                <div class="control">
                                                    <label class="radio">
                                                        <input type="radio" name="resposta">
                                                        <b class="subtitle" style="padding-left:12px">Pago con:<img
                                                                src="css\img\paypal.png"
                                                                style="position:absolute; left:130px; top:-10px"></b>
                                                    </label>
                                                </div>
                                            </article>
                                        </div>
                                        <br>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <br>


                    </div>
                    <div class="field is-horizontal">
                        <div class="field-body">
                            <div class="field">
                                <div class="button gradiente">
                                    <a class="title is-5 is-info" v-on:click="backShop"><img
                                            src="css\img\chevron-left-font-awesome.png"> voltar a página anterior</a>
                                </div>
                            </div>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <a class="button is-info is-large" style="left:150px;" href="finalizarcompra.html">
                                        FINALIZAR
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column is-3" style="font-family:Averta">
                    <div class="card"
                         style="background:#f0f0f0; box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
                        <div class="card-content">
                            <div class="content">
                                <p id="produto" class="title is-6">NÃO HÁ PRODUTO NO CARRINHO</p>
                                <ol type="1">
                                    <li v-bind:id="itens" v-for="item in product" class="subtitle is-6 is-prata"
                                        style="padding-left: 50px;">{{item}}
                                    </li>
                                </ol>


                            </div>
                        </div>
                    </div>

                    <hr class="dropdown-divider is-white">

                    <div class="card"
                         style="background-color:#f0f0f0; box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
                        <div class="card-content">
                            <div class="content">
                                <table class="title is-5 ">
                                    <tr>
                                        <td class="title is-5 is-bold">Total</td>
                                        <td class="title is-5 is-bold">R$ {{total}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card"
                         style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
                        <div class="card-content">
                            <a class="button is-link is-large" v-on:click="showShop" v-on="item in product" id="comprar">COMPRAR</a>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>


</template>

<script>

    // import {EventBus} from "../app";

    export default {
        props: ['itens'],
        data: function () {
            return {
                urlpath: window.location.pathname,
                ID_USUARIO: '',
                inicio: 12,
                itensList: [],
                product: [],
                total: 0,
                valor: 3.99,
            }
        },


        created() {
            this.ID_USUARIO = localStorage.getItem('ID_USUARIO');
            this.itensList = this.itens;
        },

        methods: {
            changeFollow: function (id_composicao, titulo, valor) {
                if (this.ID_USUARIO) {

                    if ($('#' + id_composicao).text() == '   Adicionar ao carrinho') {

                        $('#' + id_composicao).removeClass('button is-link is-medium is-rounded').addClass('button is-link is-medium is-rounded is-outlined');
                        $('#' + id_composicao).text('   Já está no carrinho');
                        $('#produto').text('PRODUTO ADICIONADO COM SUCESSO');
                        this.product.push(titulo);
                        this.total = parseFloat(this.total) + parseFloat(this.valor);
                        this.total = this.total.toFixed(2);


                    } else if ($('#' + id_composicao).text() == '   Já está no carrinho') {

                        $('#' + id_composicao).removeClass('button is-link is-medium is-rounded is-outlined').addClass('button is-link is-medium is-rounded');
                        $('#' + id_composicao).text('   Adicionar ao carrinho');
                        this.product.splice(0, 1);
                        this.total = parseFloat(this.total) - parseFloat(this.valor);
                        this.total = this.total.toFixed(2);
                        if (this.total === '0.00') {
                            $('#produto').text('NÃO HÁ PRODUTO NO CARRINHO');
                        }
                    }
                } else {
                    window.open('/login', '_self');
                }

            },

            showShop: function () {
                $('#compra').css('display', 'block');
                $('#produtos').css('display', 'none');
                $('#comprar').hide();

                $('#lojaVitural').css('display', 'none');

                if(this.product.length===0){
                    alert('Carrinho vazio');
                    window.open('/loja', '_self');

                }

            },

            backShop: function () {
                $('#compra').css('display', 'none');
                $('#produtos').css('display', 'block');
                $('#comprar').show();

                $('#lojaVitural').css('display', 'block')

            },


        }
    }

</script>