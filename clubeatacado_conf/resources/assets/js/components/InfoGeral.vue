<template>
   <div>
       <!--------------------------------------TABELA DE PREÇOS--------------->
       <article class="media" style="margin-left: 8%; border: 0px solid rgba(219, 219, 219, 0.5);">

           <div class="card" style="background-color: #fafafa; box-sizing: initial; box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">
               <div class="card-content">
                   <div class="columns" style="margin-right: -60px">
                       <slot name="preco"></slot>
                   </div>
               </div>

           </div>

       </article>

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

       <!--------------------------------------COMENTÁRIOS RECENTES--------------->
       <article class="media" style="margin-left: 7%; border: 0px solid rgba(219, 219, 219, 0.5);display: block;">
           <div class="content">
                
               <div class="box musica">
              
                   <p class="subtitle is-6 is-bold">Comentários recentes</p>
                      
                        <button v-if="logado === 1"  class="button" style="color: rgb(82, 87, 99);
                                                    font-weight: bold;
                                                    background-color: rgba(82, 87, 99, 0);
                                                    border-color: #d73c38;
                                                    margin-left:80%
                                                    width: 290px;
                                                    margin-top: -5%" 
                                                    data-toggle="modal" data-target="#coments">Escrever uma avaliação
                        </button>
                   <slot name="comentarios"></slot>

               </div>
              
           </div>
       </article>
        <!-- Modal -->
        <div class="modal" id="coments" >
            <div class="modal-card" style="width: 40%; margin-top:10%">

                <section class="modal-card-body body-modal" style="width: 100%;">
                    <header class="rectangle-10" style=" width: 100%; margin-bottom: 2%">
                        <button class="button" id="close" data-dismiss="modal" aria-label="Close" style="margin-top: -4%;float: right; background: #d6dce400;border: transparent;"><i class="fa fa-times fa-1x" style="color: #808080;"></i></button>
                        <p class="subtitle is-5" style="text-align: center;">
                            Escreva uma avaliação
                        </p>
                        <hr style="margin: 0px;" />
                    </header>
                   <div style="display: flex; margin-left: 2%;  width: 100%">
                        <div style="display:block; width: 100%">
                            <div style="display:flex; margin: 15px 0px">
                                <label class="label has-text-left" style="color:#525763; font-weight:normal">Avaliação: </label>
                                <div class="control has-icons-left">
                                    <star-rating :rating="0"
                                            :show-rating="false"
                                            :read-only="false"
                                            v-bind:increment="1"
                                            v-bind:max-rating="5"
                                            v-bind:star-size="20"
                                            @rating-selected ="setRating"
                                            id="estrela">
                                    </star-rating>
                                </div>
                            </div>
                           

                            <label class="label has-text-left" style="color:#525763; font-weight:normal">comentário: </label>
                                <div class="control">
                                    <textarea class="textarea" required maxlength="150" style="background-color:#E5E8ED;" id="comentario"></textarea>

                                </div>
                        </div>
                   </div>
                   <footer style="margin: 15px">
                       
                       <button  class="button" style="color: rgb(82, 87, 99);
                                                    font-weight: bold;
                                                    background-color: rgba(82, 87, 99, 0);
                                                    border-color: #d73c38;" 
                                                    v-on:click="save()">Salvar
                        </button>

                   </footer>
                </section>
            </div>
        </div>
   </div>
</template>

<script>
    export default {
        mounted() {
          axios.get('/clubeatacado/usuario/logado').then(response => {
              
              this.logado = response.data;
              console.log(response.data);
              console.log(this.logado)
          })
        },
        data() {
           return{
                rating: null,
                input: [],
                logado: null 
           }
        },
        methods:{
            setRating: function(rating){
                this.rating= rating;
            },
            save(){
                this.input = [
                    $("#comentario").val(),
                    this.rating,
                    localStorage.getItem('ID_ANUNCIO_PRODUTO')
                ]
                console.log(this.rating);
                if (!$('#comentario').val()) {
                    alert("campos em branco");
                    $('#comentario').css('border-bottom', '1px solid red');
                    return false
                } else if (this.rating == null) {
                    alert("adicione uma avaliação");
                  
                    return false
                } 

                axios.post('/clubeatacado/anuncio/add/comentario', {
                    input: this.input

                })
                .then(response => {
                    if(response.data == 1){
                        alert('Comentário realizado com sucesso!');
                         window.open('/clubeatacado/anuncio/produtodetalhe', '_self')
                    }else{
                        alert('Erro ao realizar comentário!');
                    }
                      
                       
                     
                })
            }
        }

    }
</script>
