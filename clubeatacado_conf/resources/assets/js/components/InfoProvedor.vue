<template>
   <div>
       <!--------------------------------------ESMODA LTDA--------------->
       <article class="media" style="text-align: justify; margin-left: 8%; border: 0px solid rgba(219, 219, 219, 0.5); width: 46%">
           <div class="content">
               <p class="subtitle is-6 is-bold">Atacadista</p>
               <slot name="vendedorDesc"></slot>
           </div>
       </article>

       <!--------------------------------------TABELA DE PREÇOS--------------->
       <article class="media" style="margin-left: 8%; border: 0px solid rgba(219, 219, 219, 0.5);">

           <div class="card" style="background-color: #ffffff; box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);width: 65%;">
               <div class="card-content">
                   <slot name="vendedor"></slot>
               </div>
           </div>

       </article>

       <!--------------------------------------OUTROS PRODUTOS DA EMPRESA--------------->
       <article class="media" style="margin-left: 8%; border: 0px solid rgba(219, 219, 219, 0.5);">

           <div class="content">
               
               <slot name="outrosAnuncios">
                 
               </slot>
           </div>
       </article>
   </div>
</template>

<script>
    export default {
        data(){
            return{
                vendedor:[]
            }
        },
        mounted() {

            console.log('Component mounted.')
        }
    }
</script>
