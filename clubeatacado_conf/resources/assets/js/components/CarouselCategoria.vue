<template>
    <!--&lt;!&ndash;------------------------------------CATEGORIAS-------------&ndash;&gt;-->
    <section class="section" style="background: rgb(255, 255, 255);">
        <div id="v-carousel" type="x/template">
            <div class="card-carousel-wrapper">
                <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div>
                <div class="card-carousel">
                    <div class="card-carousel--overflow-container">
                        <div class="card-carousel-cards" :style="{ transform: 'translateX' + '(' + currentOffset + 'px' + ')'}">
                            <div class="column" v-for="item in categorias">
                                <div class="card" style="box-shadow: rgba(0, 0, 0, 0.24) 1px -1px 5px 0px;height: 100%;"  v-on:click="catTipo(item.DS_CATEGORIA_PRODUTO)">
                                    <div class="card-image">
                                        <figure class="image is-1by1">
                                            <img src="http://i.ytimg.com/vi/GsHO1Fu1bM0/maxresdefault.jpg" style="border-top-right-radius: 5px;border-top-left-radius: 5px;" alt="Placeholder image">
                                        </figure>
                                    </div>
                                    <div class="card-content">
                                        <p class="subtitle is-bold is-6">{{item.DS_CATEGORIA_PRODUTO}}</p>
                                        <p class="subtitle is-7" style="text-align: left">{{item.DS_DESCRICAO_CATEGORIA_PRODUTO}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-carousel--nav__right" @click="moveCarousel(1)" :disabled="atEndOfList"></div>
            </div>
        </div>
    </section>
</template>
<style>


</style>
<script>
    export default {
        props:['categorias'],
        mounted() {
            console.log(this.categorias);
            console.log('kiojjio')
        },
        data() {
            return {
                currentOffset: 0,
                windowSize: 3,
                paginationFactor: 220,
            }
        },
        computed: {
            atEndOfList() {
                return this.currentOffset <= (this.paginationFactor * -1) * (this.categorias.length - this.windowSize);
            },
            atHeadOfList() {
                return this.currentOffset === 0;
            },
        },
        methods: {
            moveCarousel(direction) {
                // Find a more elegant way to express the :style. consider using props to make it truly generic
                if (direction === 1 && !this.atEndOfList) {
                    this.currentOffset -= this.paginationFactor;
                } else if (direction === -1 && !this.atHeadOfList) {
                    this.currentOffset += this.paginationFactor;
                }
            },
            catTipo(id){
                this.anuncio = $('#' + id).val();
                console.log(this.anuncio);
                localStorage.setItem('ID_ANUNCIO_PRODUTO', id);
                window.open("/categoria/tipo/"+id,'_self');
            },
        }
    }
</script>
