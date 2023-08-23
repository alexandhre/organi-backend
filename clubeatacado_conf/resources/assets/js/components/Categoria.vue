<template>
        <!--&lt;!&ndash;------------------------------------CATEGORIAS-------------&ndash;&gt;-->

        <section class="section" style="background: rgb(255, 255, 255);">
            <div class="container has-text-left">
                <h2 class="title">CATEGORIAS</h2>
                <h2 class="subtitle ">Aqui você encontrará as categorias que te ajudarão a encontrar os<br>
                    produtos ideais para o seu comercio com as ultimas novidades!</h2>
            </div>
            <br>
            <div id="v-carousel" type="x/template">
                <div class="card-carousel-wrapper">
                    <div class="card-carousel--nav__left" @click="moveCarousel(-1)" :disabled="atHeadOfList"></div>
                    <div class="card-carousel">
                        <div class="card-carousel--overflow-container">
                            <div class="card-carousel-cards" :style="{ transform: 'translateX' + '(' + currentOffset + 'px' + ')'}">
                                <div class="column" v-for="item in categorias">
                                    <div class="card" style="box-shadow: 0 2px 0 rgb(10 10 10 / 0%), 0 0 1px 0 rgb(10 10 10 / 0%); cursor: pointer" v-on:click="categoriaType(item.DS_TIPO_PRODUTO)">
                                        <div class="card-image"  >
                                            <figure class="image is-1by1">
                                                <img :src="item.DS_ICONE_TIPO_PRODUTO" style="border-top-right-radius: 5px;border-top-left-radius: 5px;" alt="Placeholder image">
                                            </figure>
                                        </div>
                                        <div class="card-content" >
                                            <p class="subtitle is-bold is-6">{{item.DS_TIPO_PRODUTO}}</p>
                                            <!-- <p class="subtitle is-7" style="text-align: left">{{item.DS_CATEGORIA_PRODUTO}}</p> -->
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

<script>
    export default {
        props:['categorias'],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                currentOffset: 0,
                windowSize: 3,
                paginationFactor: 220,
                //categoria: []
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
            categoriaType: function (categoria) {

                window.open("/clubeatacado/categoria/listar/"+categoria,'_self');
            }
        }
    }
</script>
