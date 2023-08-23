<template>
    <div >
        <div class="columns" v-for="item in list">
        <div class="column is-one-fifth">
            <div class="card" >
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img :src="'images\\'+item.DS_FOTO_PRODUTO" alt="Placeholder image">
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4">{{item.DS_PRODUTO}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

</template>

<script>
    export default {
        props: ['list'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>