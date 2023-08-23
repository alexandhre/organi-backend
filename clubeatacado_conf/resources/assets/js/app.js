
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from 'vue';
import Vuex from 'vuex';

require('./bootstrap');

import VueChatScroll from 'vue-chat-scroll';
Vue.use(VueChatScroll);


import VueFire from 'vuefire'
Vue.use(VueFire);

window.Vue = require('vue');
Vue.use(Vuex);

import StarRating from 'vue-star-rating';
Vue.component('star-rating', StarRating);
//
import InfiniteScroll from 'v-infinite-scroll';
Vue.use(InfiniteScroll);

import vSelect from 'vue-select'

Vue.component('v-select', vSelect);

import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'

Vue.use(Autocomplete);


import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));


import tipopessoa from './components/TipoPessoa.vue'
import editarperfil from './components/Editarperfil.vue'
import anuncie from './components/Anuncie.vue'
import menusuario from './components/MenuOpcoes.vue'
import meuproduto from './components/MeusProdutos.vue'
import produtodetalhe from './components/ProdutoDetalhe.vue'
import espcTecnica from './components/EspcTecnica.vue'
import infoGeral from './components/InfoGeral.vue'
import infoProvedor from './components/InfoProvedor.vue'
import categorias from './components/Categoria.vue'
import promocoes from './components/Promocoes.vue'
import exclusivos from './components/Exclusivos.vue'
import menucategoria from './components/MenuCategoria.vue'
import loja from './components/Loja.vue'
import descontos from './components/Descontos.vue'
import todaspromocoes from './components/TodasPromocoes.vue'
import todascategorias from './components/TodasCategorias.vue'
import filtrocategoria from './components/Filtrocategoria.vue'
import tipocategoria from './components/TipoCategoria.vue'
import novapromocao from './components/AtivarPromocao.vue'
import chat from './components/Chat.vue'
import favorito from './components/Favoritos.vue'
import carrinho from './components/Carrinho.vue'
import busca from './components/Busca.vue'
import produtos from './components/ProdutoSelecionado.vue'
import historico from './components/Historico.vue'
import destaque from './components/Destaque.vue'
import anuncioeditar from './components/AnuncioEditar.vue'

const app = new Vue({
    el: '#app',
    components:{
        tipopessoa,
        editarperfil,
        anuncie,
        espcTecnica,
        menusuario,
        meuproduto,
        produtodetalhe,
        infoGeral,
        infoProvedor,
        categorias,
        promocoes,
        exclusivos,
        menucategoria,
        loja,
        descontos,
        todaspromocoes,
        todascategorias,
        filtrocategoria,
        tipocategoria,
        novapromocao,
        chat,
        favorito,
        carrinho,
        busca,
        produtos,
        StarRating,
        historico,
        destaque,
        anuncioeditar
    }
});
const topo = new Vue({
    el: '#topo',
    components:{
        busca
    }
});

const menu = new Vue({
    el: '#menu',
    components:{
        menucategoria
    }
});
