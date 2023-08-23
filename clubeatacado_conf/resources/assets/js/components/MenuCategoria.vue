<template>
    <div >
        <!--------------------------------------HEROOOOOOO-------------->
        <section class="section" style="background: #ff7063;padding: 0rem 0rem;">

            <div class="tabs is-centered">

                <ul style="border-bottom-color: #dcdcdc00; margin-left: 50px">
                    <li class="is-active a" v-if="urlpath === '/clubeatacado/home' || urlpath === '/clubeatacado' ">
                        <a href="/clubeatacado/home">
                            <span>Popular</span>
                        </a>
                    </li>
                    <li class="" v-else>
                        <a href="/clubeatacado/home">
                            <span style="color: #D73C38">Popular</span>
                        </a>
                    </li>
                    <li class="is-active a" style="padding-left: 50px;" v-if="urlpath === '/clubeatacado/anuncio/destaques'">
                        <a href="/clubeatacado/anuncio/destaques">
                            <span >Destacados</span>
                        </a>
                    </li>
                    <li style="padding-left: 50px;" v-else>
                        <a href="/clubeatacado/anuncio/destaques">
                            <span style="color: #D73C38">Destacados</span>
                        </a>
                    </li>
                    <li class="is-active a" style="padding-left: 50px;"  v-if="urlpath === '/clubeatacado/anuncio/promocoes'">
                        <a href="/clubeatacado/anuncio/promocoes">
                            <span >Promoções</span>
                        </a>
                    </li>
                    <li style="padding-left: 50px;" v-else>
                        <a href="/clubeatacado/anuncio/promocoes">
                            <span  style="color: #D73C38">Promoções</span>
                        </a>
                    </li>
                    <li style="padding-left: 50px;" class="is-active a" v-if="urlpath === '/clubeatacado/categoria/todas'">
                        <a href="/clubeatacado/categoria/todas" >
                            <span >Categorias</span>
                        </a>
                    </li>
                    <li style="padding-left: 50px;" v-else>
                        <a href="/clubeatacado/categoria/todas">
                            <span style="color: #D73C38">Categorias</span>
                        </a>
                    </li>

                        <div v-for="(item, index ) in categoria.slice(0, 2)" :key="index">
                        <li style="padding-left: 50px;"  class="is-active a" v-if="urlpath === '/clubeatacado/categoria/listar/'+item.DS_TIPO_PRODUTO || item.DS_TIPO_PRODUTO == cat">
                            <a :href='"/clubeatacado/categoria/listar/" + item.DS_TIPO_PRODUTO' >
                                <span> {{item.DS_TIPO_PRODUTO}}</span>
                            </a>
                        </li>
                        <li style="padding-left: 50px;"  v-else>
                            <a :href='"/clubeatacado/categoria/listar/" + item.DS_TIPO_PRODUTO' >
                                <span style="color: #D73C38" >{{item.DS_TIPO_PRODUTO}}</span>
                            </a>
                        </li>
                        </div>

                    <li style="padding-left: 50px; ">
                        <div class="dropdown is-hoverable">
                            <div class="dropdown-trigger ">
                                <button class="button gradiente" style="background-color: #FF7063">
                                    <span  style="color: #D73C38" >Mais</span>
                                </button>
                            </div>
                            <div class="dropdown-menu"  style="margin-left: -220%;">
                                <div class="dropdown-content">
                                    <div  v-for="(item, index) in categoria.slice(2)" :key="index">
                                        <a :href='"/clubeatacado/categoria/listar/" + item.DS_TIPO_PRODUTO'  style="border-bottom-color: #ffffff00; justify-content: flex-end">
                                        {{item.DS_TIPO_PRODUTO}}
                                        </a>
                                        <a v-if="item.DS_TIPO_PRODUTO == cat">
                                            {{selectPosition(cat)}}
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
         props: {
            cat: {
                type: String,
                default: ''
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.urlpath = decodeURIComponent(this.urlpath);
            axios.get('/clubeatacado/categoria/menu').then(resp =>{
                this.categoria = resp.data;
                //this.slice(0, 5)
                
                for(var i=0; i<this.categoria.length; i++){
                    if('/clubeatacado/categoria/listar/'+this.categoria[i].DS_TIPO_PRODUTO === this.urlpath){
                         this.changePosition(this.categoria, i,0)
                    }
                }
            });
           
          
           
        },
        data(){
            return{
                urlpath: window.location.pathname,
                categoria:'',

            }
        },
        created(){

        },
        methods:{
            changePosition : function (arr, from, to) {
                    arr.splice(to, 0, arr.splice(from, 1)[0]);
                    //this.categoria =arr;
                    return  arr;
            },
            selectPosition: function(catg){
                for(var i=0; i<this.categoria.length; i++){
                    
                    if(this.categoria[i].DS_TIPO_PRODUTO  == catg){
                         console.log(this.categoria[i]);
                         this.changePosition(this.categoria, i,0)
                    }
                }
                
            }
        }

    }
</script>
