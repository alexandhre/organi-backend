<template>
    <div>
        <!--------------------------------------CATEGORIAS--------------->

        <section class="section">

            <div class="container has-content-centered">
                <p class="title is-1 has-text-centered" style="font-weight: bold;color: #2764AC">Como funciona</p>
                <p class="subtitle is-5 has-text-centered is-carvao">A maneira mais fácil de encontrar o que quer comprar</p>
            </div>
        </section>

        <!--------------------------------------DEMANDAS--------------->

        <section class="section">
            <div class="columns is-centered">
                <div class="column" style="padding-left:260px; text-align:center">
                    <figure>
                        <img class="image is-2by3" src="css\img\ilu_1.png" alt="ilu_1">
                    </figure>
                </div>
                <div class="column has-text-left" style="padding-left: 120px;">
                    <p class="subtitle is-4" style="padding-top: 100px; width: 350px">
                        In hac habitasse platea dictumst.
                        Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique.</p>
                </div>
            </div>

            <div class="columns is-centered">
                <div class="column has-text-left" style="padding-left: 260px;">
                    <p class="subtitle is-4" style="padding-top: 100px; width: 300px">
                        In hac habitasse platea dictumst.
                        Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique.</p>
                </div>
                <div class="column" style="padding-left:120px; text-align:center">
                    <figure>
                        <img  class="image is-2by3" src="css\img\ilu_2.png" alt="ilu_2">
                    </figure>
                </div>

            </div>

            <div class="columns is-centered">
                <div class="column" style="padding-left:260px; text-align:center">
                    <figure>
                        <img class="image is-2by3" src="css\img\ilu_3.png" alt="ilu_3">
                    </figure>
                </div>
                <div class="column has-text-left" style="padding-left: 120px;">
                    <p class="subtitle is-4" style="padding-top: 100px; width: 300px">
                        In hac habitasse platea dictumst.
                        Vivamus adipiscing fermentum quam volutpat aliquam. Integer et elit eget elit facilisis tristique.</p>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
