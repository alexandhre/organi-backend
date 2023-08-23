<template>
    <div class="">
        <!--------------------------------------ITENS EXCLUSIVOS--------------->
        <section class="section" style="background: rgb(255, 255, 255);">
            <!--<div class="container has-text-left" v-if="login === 1">-->
                <!--<h2 class="title">ITENS EXCLUSIVOS PARA VOCÊ</h2>-->
                <!--<h2 class="subtitle ">Nós separamos os produtos que são tendência<br>-->
                    <!--no mercado, exclusivamente para você</h2>-->
            <!--</div>-->
            <div class="container has-text-left">
                <h2 class="title">ITENS MAIS PROCURADOS</h2>
                <h2 class="subtitle ">Nós separamos os produtos que são tendência<br>
                    no mercado, exclusivamente para você</h2>
            </div>
            <br>
            <div class="container has-text-left" style="margin-top: 1%;">
                <div class="columns is-multiline is-center"  style="width: 1200px" >
                    <div class="columns is-4" style="width: 25%; height: 25%; margin-left: 1px; margin-top: 1px;"  v-for="item in anuncio">
                        <div class="card" style="height: 400px;">
                            <div class="card-image">
                                <figure class="image is-2by1">
                                    <img v-on:click="detalheOpen(item.ID_ANUNCIO_PRODUTO)" :src="'/images/anuncios/'+item.ID_ANUNCIO_PRODUTO+'/'+item.foto" onerror="this.onerror=null;this.src='/images/photo.png';" style="margin-left: 7px; margin-top: 8px" alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content" style="margin-left: -20px">

                                <p class="subtitle is-carvao is-5 is-bold">{{item.DS_ANUNCIO_PRODUTO}}</p>
                                <p class="subtitle is-7">{{item.DS_DETALHE_PRODUTO}}</p>
                                <p class="subtitle is-carvao is-8">Disposto a pagar até</p>
                                <p class="subtitle is-5 is-bold" style="color: #23A7FB">R$  {{item.VL_TIPO_ANUNCIO - item.VL_DESCONTO}}</p>

                            </div>
                            <button class="button gradiente" style="margin-top: 5px; background-color:#23A7FB; color:#ffffff; font-size: 14px; width:255px; height: 32px;" v-on:click="chatOpen()">CHAT</button>
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
                inicio: 4,
                urlpath: window.location.pathname,
            }
        },
        mounted() {
            if(this.urlpath === '/anuncio/produto/type'){
                console.log( localStorage.getItem('produto'));

                if(localStorage.getItem('produto') !== null){
                    axios.get('/anuncio/produtos/'+ localStorage.getItem('categoria')).then(resp =>{
                        if(resp.data['0'].length !== 0){
                            this.anuncio = resp.data['0'];
                            console.log(this.anuncio);

                        }else{
                            this.anuncio = resp.data['1'];
                            console.log(this.anuncio);
                        }

                    });
                }
            }else{
                axios.get('/anuncio/all/').then(resp =>{

                    this.anuncio = resp.data;
                    console.log(this.anuncio);

                });
            }

            var vm = this;
            window.addEventListener('scroll', function(e){
                var scrollPos = window.scrollY;

                var winHeight = window.innerHeight;
                var docHeight = document.documentElement.scrollHeight;

                if(scrollPos === (docHeight-winHeight)) {

                    // vm.anuncio = [];
                    vm.cont = vm.inicio + vm.cont;
                    // axios.get('/clubeatacado/anuncio/maisvisitado/MoreAnuncio/' + vm.cont).then(res => {
                    //     for (var i = 0; i < res.data[0].length; i++) {
                    //
                    //         vm.anuncio.push(res.data[0][i]);
                    //
                    //     }
                    //     //vm.anuncio =   vm.item;
                    //     console.log(  vm.anuncio);
                    //
                    // });
                }

            })
        },
        methods:{
            detalheOpen(id){
                this.anuncio = $('#' + id).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open("/anuncio/produto/detalhe",'_self');
            },
            chatOpen(id){
                this.anuncio = $('#' + id).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open("/usuario/chat",'_self');
            },
        }
    }
</script>
