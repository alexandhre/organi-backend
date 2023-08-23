<template>
    <section class="section">

        <div class="container has-text-centered">
             <div class="container has-text-left" >
                <h2 class="title">Meu carrinho:</h2>
              
            </div>
           
            <div class="columns">

                <div class="column" id="produtos" style="display: block">
                    <div class="box musica" v-for="(item, index) in this.itens" :key="index" style="background:#fafafa;display: flex;">
                        <div>
                            <article class="media" >
                                <figure>
                                    <img style="height: 86px;width: 86px;"
                                         :src="item['0'].photo" alt="Image"/>
                                </figure>
                            </article>
                        </div>
                        <div style="width: 50%">
                            <p class="title is-6 is-bold has-text-left" style="margin-left:10px;font-family:Arial">
                                {{item['0'].DS_ANUNCIO_PRODUTO}}</p>
                            <p class="subtitle is-warning has-text-left" style="margin-left:10px;">R$ {{item['0'].price | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  })  }}</p>
                            <p class="title is-8 is-bold has-text-left" v-on:click="detailProduto(item['0'].ID_ANUNCIO_PRODUTO)"  style="margin-left:10px;font-family:Arial; cursor:pointer; margin-top: auto;">
                                Ver anúncio</p>
                        </div>
                        <div class="field is-grouped" style="display: block">
                            <div>
                                <a class="button gradiente" style="background: none;">
                                        <span class="icon" v-on:click="copyTestingCode(item['0'].ID_ANUNCIO_PRODUTO)">
                                          <i class="fas fa-share-alt" style="color: #9E0011"></i>
                                            <input type="hidden" :id="'testing-code'+item['0'].ID_ANUNCIO_PRODUTO" :value="item['0'].urlsearch">
                                        </span>
                                </a>
                                <a class="button gradiente" style="background: none;" v-on:click="addFavarito(item['0'].ID_ANUNCIO_PRODUTO ,index)">
                                 <span class="icon has-text-danger" v-if=" item['0'].fav === null">
                                  <i class="far fa-heart" style="display: block; color: #9E0011"  :id="'heart1'+index" ></i>
                                  <i class="fas fa-heart" style="display: none; color: #9E0011 " :id="'heart2'+index"></i>
                                </span >
                                    <span class="icon has-text-danger" v-else>
                                  <i class="far fa-heart" style="display: none; color: #9E0011" :id="'heart1'+index" ></i>
                                  <i class="fas fa-heart" style="display: block; color: #9E0011 " :id="'heart2'+index"></i>
                                </span>
                                </a>
                                 <a class="button gradiente" style="background: none;">
                                        <span class="icon" v-on:click="remove(index)">
                                          <i class="far fa-trash-alt" style="color: #9E0011"></i>
                                        </span>
                                </a>
                                 
                            </div>
                            <div style="display: flex; margin-top: 7%">
                                <p class="control">
                                    <a class="button gradiente" style="background: none;" v-on:click="plus(index)">
                                  <span class="icon has-text-black">
                                  <i class="fas fa-plus-circle" ></i>
                                </span>
                                    </a>
                                </p>
                                <p class="control">
                                    <input disabled style="color:#23A7FB; font-size: 24px;font-weight: bold; border: 0px;padding: 0px; max-width: 30px; background-color: #fafafa; text-align: center" type="number" :min="item['0'].QT_MINIMA_PEDIDO" :max="item['0'].QT_DISPONIVEL" v-model="quant[index].q" />
                                </p>
                                <p class="control" >
                                    <a class="button gradiente" style="background: none;" v-on:click="min(index)">
                                 <span class="icon" style="color: gray">
                                 <i class="fas fa-minus-circle"></i>
                                </span>
                                    </a>
                                </p>
                            </div>
                            <article class="media" >
                                <div class="content" style="display: inline-flex; width:100%">
                                    <div>
                                        <label class=button id=2 style="width: 20px; height: 25px; border-radius: 100px; border-color: black"
                                               :style=" (item['0'].cor !== null) ? {background: item['0'].cor} : 'background: #fafafa; border:none' "
                                        ><i
                                                class="fas fa-check"
                                                style="position: absolute; left: 20px; bottom: 20px;
                                                        color: #ffffff;width: 20px;height: 20px; border-radius: 100px; display:none"></i>
                                        </label>
                                        <a class="button gradiente" style="background: none;">
                                            <p class="title is-6 is-bold has-text-left"  style="font-family:Arial; margin-top: auto;">
                                            {{item['0'].tamanho}}</p>
                                        </a>
                                    </div>
                                   
                                </div>
                            </article>
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
                                                            tarjeta<img src="/clubeatacado\css\img\cartao.png"
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
                                                        <b class="subtitle" style="padding-left:12px">Pago com:<img
                                                                src="/clubeatacado\css\img\paypal.png"
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
                </div>

                <div class="column is-3" style="font-family:Averta; position: static; margin-top: -6%;">
                    <div class="card"
                         style="background:#fafafa; box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
                        <div class="card-content">
                            <div class="container ">
                                <h2 id="produto" class="subtitle " style="font-family: Roboto;">NÃO HÁ PRODUTO NO CARRINHO</h2>
                                <!-- <p  class="subtitle "></p> -->
                                <ol type="1">
                                    <li v-bind:id="itens" v-for="(item, index) in product" :key="index" class="subtitle is-6 is-prata"
                                    style="padding-left: 50px;">{{item}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <hr class="dropdown-divider is-white">
                    <div class="card"
                         style="background-color:#fafafa; box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
                        <div class="card-content">
                            <div class="content">
                                <table class="title is-5 ">
                                    <tr>
                                        <td class="title is-5 is-bold" style="font-family: Roboto;">Total:</td>
                                        <td class="title is-5 is-bold" style=" ">R$ {{total | currency('', 2, { thousandsSeparator: '.', decimalSeparator: ','  })}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="field is-grouped" style="margin-top: 80px;margin-bottom: 80px; justify-content: center;">
                        <p class="control">
                            <a class="button  is-block has-button-yellow is-5  is-pulled-left is-medium has-text-weight-bold " style="font-family: Roboto;" id="comprar">COMPRAR</a>
                        </p>
                    </div>
                    <!-- <div class="card"
                         style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
                        <div class="card-content">
                            <a class="button  is-block has-button-yellow is-5  is-pulled-left is-medium has-text-weight-bold " style="margin-left: 20%;" id="comprar">COMPRAR</a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
</template>
<style>
    /* The container */
    .selecionar {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .selecionar input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #fafafa;
        border: 1px solid;
        border-radius: 40%;
    }

    /* On mouse-over, add a grey background color */
    .selecionar input:hover ~ .checkmark {
        border-color: #9e0011;
    }

    /* When the checkbox is checked, add a blue background */
    .selecionar input:checked ~ .checkmark {
        background-color: #9e0011;
        border-color: #9e0011;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .selecionar input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .selecionar .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<script>

    export default {
        // props: ['itens'],
        data: function () {
            return {
                urlpath: window.location.pathname,
                inicio: 12,
                itensList: [],
                itens:[],
                product: [],
                total: 0,
                pageNumber: 0,
                selected: [],
                allSelected: '0',
                toggle:[],
                quant: [],
            }
        },
        mounted(){
            this.itensList = JSON.parse(localStorage.getItem('anuncio'));
            axios.post('/clubeatacado/carrinho/listar', {
                input:  this.itensList

            })
                .then(response => {
                    this.itens = response.data;       
                    console.log(response.data);        
                    for(var i=0; i< response.data.length; i++){
                       // console.log(response.data[i][0]);
                        this.quant.push(
                            {
                                q: parseInt(this.itens[i][0].quantidade)
                            }
                        )
                        
                        this.itens[i][0].price = (this.itens[i][0].price - this.itens[i][0].VL_DESCONTO);
                        var itemPreco =  this.itens[i]['0'].precos; ;
                    
                        for(var j=0; j< itemPreco.length; j++) {
                      
                            if(this.quant[i].q >= itemPreco[j].QT_INICIAL &&  this.quant[i].q <= itemPreco[j].QT_FINAL){
                               
                                this.itens[i][0].price = itemPreco[j].VL_PRODUTO;
                                break;
                            }
                        }
                       
                        this.changeFollow(this.itens[i][0].ID_ANUNCIO_PRODUTO, this.itens[i][0].DS_ANUNCIO_PRODUTO, i,this.itens[i][0].price);
                        // this.toggle[i].select = '1';
                    }
                    
                })
                .catch(e => {
                    console.log('deu erro');
                });
           
        },

        methods: {
            copyTestingCode (id) {
                let testingCodeToCopy = document.querySelector('#testing-code'+id);
                testingCodeToCopy.setAttribute('type', 'text') ;   // 不是 hidden 才能複製
                testingCodeToCopy.select();
                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    alert('Link copiado!');
                } catch (err) {
                    alert('Oops, erro ao copiar link!');
                }

                /* unselect the range */
                testingCodeToCopy.setAttribute('type', 'hidden');
                window.getSelection().removeAllRanges()
            },
            changeFollow: function (id_composicao, titulo, index, valor) {

               
                var itemPreco =  this.itens[index]['0'].precos;
                
                for(var i=0; i< itemPreco.length; i++) {

                    if(this.quant[index].q > itemPreco[i].QT_INICIAL &&  this.quant[index].q < itemPreco[i].QT_FINAL){
                        valor = itemPreco[i].VL_PRODUTO;

                    }
                }

                if (id_composicao) {

                    $('#produto').text('PRODUTO ADICIONADO COM SUCESSO');
                    this.product.push(titulo);
                    this.total = parseFloat(this.total) + parseFloat(valor * this.quant[index].q);
                    this.total = this.total.toFixed(2);
                   

                }else{
                   console.log('erro')
                }
            },
            // selectAll: function(){
            //     if(this.total ===0.00){
            //         if (this.allSelected === '0'){
            //             for (var i = 0; i <this.itens.length; i++) {
            //                 this.toggle[i].select = '1';


            //                 document.getElementById(this.itens[i][0].ID_ANUNCIO_PRODUTO).checked = true;
            //                 $('#produto').text('PRODUTO ADICIONADO COM SUCESSO');
            //                 this.product.push(this.itens[i][0].DS_ANUNCIO_PRODUTO);
            //                 this.total = parseFloat(this.total) + parseFloat(this.itens[i][0].price * this.quant[i].q);
            //                 this.total = this.total.toFixed(2);

            //             }

            //         }else{
            //             for (var i = 0; i <this.itens.length; i++) {
            //                 this.toggle[i].select = '0';
            //                 document.getElementById(this.itens[i][0].ID_ANUNCIO_PRODUTO).checked = false;
            //                 this.product.splice(this.product.indexOf(this.itens[i][0].DS_ANUNCIO_PRODUTO), 1);
            //                 this.total = parseFloat(this.total) - parseFloat(this.itens[i][0].price * this.quant[i].q);
            //                 this.total = this.total.toFixed(2);
            //                 if (this.total === '0.00') {
            //                     $('#produto').text('NÃO HÁ PRODUTO NO CARRINHO');
            //                 }

            //             }

            //         }
            //     }else{

            //         if (this.allSelected === '0'){

            //             this.total = 0.00;
            //             this.product= [];
            //             for (var i = 0; i <this.itens.length; i++) {
            //                 this.toggle[i].select = '1';

            //                 document.getElementById(this.itens[i][0].ID_ANUNCIO_PRODUTO).checked = true;
            //                 $('#produto').text('PRODUTO ADICIONADO COM SUCESSO');
            //                 this.product.push(this.itens[i][0].DS_ANUNCIO_PRODUTO);
            //                 this.total = parseFloat(this.total) + parseFloat(this.itens[i][0].price * this.quant[i].q);
            //                 this.total = this.total.toFixed(2);

            //             }

            //         }else{
            //             this.total = 0.00;
            //             this.product= [];

            //             for (var i = 0; i <this.itens.length; i++) {
            //                 this.toggle[i].select = '0';

            //                 document.getElementById(this.itens[i][0].ID_ANUNCIO_PRODUTO).checked = false;
            //                 this.product.splice(this.product.indexOf(this.itens[i][0].DS_ANUNCIO_PRODUTO), 1);
            //                 this.total = parseFloat(this.total) - parseFloat(this.total * this.quant[i].q);
            //                 this.total = this.total.toFixed(2);
            //                 if (this.total === '0.00') {
            //                     $('#produto').text('NÃO HÁ PRODUTO NO CARRINHO');
            //                 }

            //             }

            //         }
            //     }


            // },
            plus(index){
                var itemPreco =  this.itens[index]['0'].precos;
                
                if( this.quant[index].q < this.itens[index]['0'].QT_DISPONIVEL) {
                    this.quant[index].q =  this.quant[index].q +1
                
                
                    for(var i=0; i< itemPreco.length; i++) {

                        if(this.quant[index].q >= itemPreco[i].QT_INICIAL &&  this.quant[index].q <= itemPreco[i].QT_FINAL){
                            this.itens[index]['0'].price = itemPreco[i].VL_PRODUTO;
                            break;
                        }else{
                            this.itens[index]['0'].price = this.itens[index]['0'].VL_PRODUTO_UNITARIO - this.itens[index]['0'].VL_DESCONTO;
                        }

                    }

                        var itemPreco =  this.itens[index]['0'].precos;
                        this.total = 0;
                        for(var i=0; i< this.itens.length; i++) {
                            
                                this.total = this.total + (this.itens[i]['0'].price * this.quant[i].q);
                                this.total = this.total; 
 
                        }
                    
                }
            },
            min(index){
                var itemPreco =  this.itens[index]['0'].precos;
                if( this.quant[index].q > this.itens[index]['0'].QT_MINIMA_PEDIDO) {
                    this.quant[index].q =  this.quant[index].q -1
            
                for(var i=0; i< itemPreco.length; i++) {

                    if(this.quant[index].q >= itemPreco[i].QT_INICIAL &&  this.quant[index].q <= itemPreco[i].QT_FINAL){
                        this.itens[index]['0'].price = itemPreco[i].VL_PRODUTO;
                        break;

                    }else{
                        console.log(this.itens[index]['0'].VL_PRODUTO_UNITARIO);
                        this.itens[index]['0'].price = this.itens[index]['0'].VL_PRODUTO_UNITARIO - this.itens[index]['0'].VL_DESCONTO;
                    }

                }
                     var itemPreco =  this.itens[index]['0'].precos;
                        this.total = 0;
                        for(var i=0; i< this.itens.length; i++) {
                            
                                this.total = this.total + (this.itens[i]['0'].price * this.quant[i].q);
                                this.total = this.total; 
 
                        }
                }
            },
            showShop: function () {
                $('#compra').css('display', 'block');
                $('#produtos').css('display', 'none');
                $('#comprar').hide();

                $('#lojaVitural').css('display', 'none');

                // if(this.product.length===0){
                //     alert('Carrinho vazio');
                //     window.open('/musi/loja', '_self');
                //
                // }

            },
            backShop: function () {
                $('#compra').css('display', 'none');
                $('#produtos').css('display', 'block');
                $('#comprar').show();

                $('#lojaVitural').css('display', 'block')

            },
            addFavarito(id ,index){
                axios.get('/clubeatacado/usuario/favoritos/add/' + id ).then(res => {

                    if(res.data !== 0){
                        $('#heart1'+index).css('display','none');
                        $('#heart2'+index).css('display','block');
                    }else{
                        $('#heart1'+index).css('display','block');
                        $('#heart2'+index).css('display','none');
                    }

                })
                    .catch(e => {
                        console.log('deu erro');
                    });
            },
            remove(index){
                var array = JSON.parse(localStorage.getItem('anuncio'));
                //console.log(array);
                if (index > -1) {
                   array.splice(index, 1);
                }
                localStorage.setItem('anuncio',[JSON.stringify(array)]);
                window.open('/clubeatacado/usuario/carrinho','_self');

            },
            detailProduto: function (id_anuncio) {
                this.anuncio = $('#' + id_anuncio).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id_anuncio);
                window.open("/clubeatacado/anuncio/produtodetalhe",'_self');
            }
        }
    }

</script>