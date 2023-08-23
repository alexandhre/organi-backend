<template>
       <div>
           <!--------------------------------------TABELA DE CORES--------------->
           <article class="media" style="margin-left: 8%; border: 0px solid rgba(219, 219, 219, 0.5);">
               <div class="content">
                   <p class="subtitle is-6 is-bold">Cores</p>
                   <div class="card" style="box-shadow: 0 0px 0px #EB9D9B, 0 0 0 0px #EB9D9B">
                       <slot name="cor"></slot>
                   </div>
               </div>
           </article>

           <!--------------------------------------TAMANHO INFORMAÇÃO--------------->
           <article class="media" style="margin-left: 8%; border: 0px solid rgba(219, 219, 219, 0.5);">
               <div class="content">
                   <p class="subtitle is-6 is-bold">Tamanho</p>
                   <slot name="tamanho"></slot>
               </div>
           </article>

           <!--------------------------------------CERTIFICADOS--------------->
           <article class="media" style="margin-left: 8%; border: 0px solid rgba(219, 219, 219, 0.5);">
               <div class="content">
                   <p class="subtitle is-6 is-bold">Certificados de qualidade</p>
                   <div class="card" style="box-shadow: 0 0px 0px #EB9D9B, 0 0 0 0px #EB9D9B">
                       <div class="columns">
                           <div class="column">
                               <slot name="certificado"></slot>
                           </div>
                       </div>
                   </div>
               </div>
           </article>

           <!--------------------------------------FOTOGRAFIAS DA FABRICA--------------->
           <article class="media" style="margin-left: 8%; border: 0px solid rgba(219, 219, 219, 0.5);">
               <div class="content">
                   <p class="subtitle is-6 is-bold">Fotografias da fábrica</p>
                   <div class="card" style="box-shadow: 0 0px 0px #EB9D9B, 0 0 0 0px #EB9D9B">
                       <div class="columns">
                           <div class="column">
                              <slot name="fabrica"></slot>
                           </div>
                       </div>
                   </div>
               </div>
           </article>
       </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
