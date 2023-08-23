<template>
    <div style="margin-bottom: 5%;">
        <div class="columns" v-if="this.list[0].menssagem !== 'sem conversa' ||  this.id">

            <!-- Chat Pessoa-->
            <div class="column is-4 is-paddingless list-pessoas" style="background:#F5F6F7; height:100vh; overflow-y: auto;"v-if="this.list[0].menssagem !== 'sem conversa' ||  this.id" >
                <div class="card-content" style="padding: 5%">
                    <article class="media" style="border-top: 0px; background-color: rgb(233, 234, 239); cursor: pointer;" v-for="item in list" v-on:click="showMessage(item.colletctionId, item.nome, item.usuarioId, item.foto, item.usuarioLogin, item.review)">
                        <div class="media" style="border-top: 1px solid rgba(255, 255, 255, 0); width: 100%;"
                             v-bind:style=" (item.usuarioId === ''+sender) ? 'border-bottom: 1px solid rgb(158, 0, 17);' : 'border: none;' ">
                            <div class="media-left">
                                <a class="image">
                                    <img :src="item.foto" class="is-rounded"  style="position:relative;top:10px;left:10px; height: 55px; width:55px" onerror="this.onerror=null;this.src='/clubeatacado/images/uploadImage.png';">
                                </a>
                                <br>
                            </div>
                            <div class="media-content" style="margin-top: 15px; margin-left: 3%;">
                                <div class="content" style="display:flex">
                                    <p style="max-height: 57px;max-width: 100%;overflow-y: hidden; width:100%">
                                        <strong class="subtitle is-5 is-danger">{{item.nome}}</strong>
                                        <small class="subtitle is-9" style="margin-left: 11%;">{{item.dataMensagem}}</small>

                                        <br>
                                        <strong class="subtitle is-7">{{item.mensagem}}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

            </div><!-- End/list-pessoas-->
            <div class="column" style="width: 900px" v-if="this.id">

                <div class="card" style="width: 100%;border-radius: 5px;box-shadow: 0 1px 0 rgba(10, 10, 10, 0.1), 0 0 1px 1px rgba(10, 10, 10, 0.1)">
                    <div class="card-content">
                        <div class="media"  style="border-top: 1px solid rgba(255, 255, 255, 0);">
                            <div class="media-left">
                                <a class="image">
                                    <img class="is-rounded" style="position:relative;top:10px;max-height:72PX; height: 72px; width:72px" :src="foto"  onerror="this.onerror=null;this.src='/clubeatacado/images/uploadImage.png';"/>
                                </a>
                                <br>
                            </div>
                            <div class="media-right">
                                <h4 class="subtitle is-6 is-bold" style="position:relative;top:15px;" id="nomeanunciante"></h4>
                                <figure style="bottom:85px;right: 100px">
                                    <star-rating :rating="star"
                                                 :show-rating="false"
                                                 :read-only="true"
                                                 v-bind:increment="1"
                                                 v-bind:max-rating="5"
                                                 v-bind:star-size="20">
                                    </star-rating>
                                </figure>

                            </div>
                            <div class="dropdown is-hoverable" style="position: relative; right: -55%;">
                                <div class="dropdown-trigger">
                                    <button class="button gradiente" aria-haspopup="true" aria-controls="dropdown-menu" style="background: rgba(255,255,255,0)">
                                                  <span class="icon is-small">
                                                    <i class="fas fa-bars" aria-hidden="true" style="color: #0a0a0a"></i>
                                                  </span>
                                    </button>
                                </div>
                                <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                    <div class="dropdown-content" style="margin-left: -80px;width: 67%;">
                                        <a href="#" class="dropdown-item" v-on:click="removeMessage">
                                            Apagar conversa
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--<i class="fas fa-bars" style="position: relative; "></i>-->
                        </div>
                    </div>
                </div>


                <!-- Card Conversa -->
                <section id="main " class="card" style="width: 100%; margin-top: 2%; margin-bottom: 2%; border-radius: 5px;box-shadow: 0 1px 0 rgba(10, 10, 10, 0.1), 0 0 1px 1px rgba(10, 10, 10, 0.1); ">
                    <section id="messages" v-chat-scroll>

                        <div v-for="message in messages"> 
                            <article v-if="''+message.usuarioLogin !== ''+message.senderId">
                                    <div class="msg">
                                        <div class="tri" style="transform: rotateX(0deg);"></div>
                                        <div class="msg_inner"  style="word-wrap: break-word;max-width: 350px;">{{message.content}}</div>
                                    </div>
                                </article>
                                <article class="right"  v-else>
                                    <div class="msg">
                                        <div class="tri" style="height: 100%"></div>
                                        <div class="msg_inner green" style="word-wrap: break-word;max-width: 350px;">{{message.content}}</div>
                                    </div>
                                </article>
                        </div>
                    </section>
                </section>
                <div class="send-msg">
                    <textarea placeholder="Digite aqui..." v-model="newMessage"></textarea>
                    <a class="btnSend  " v-on:click="addMessage">
                                <span class="icon">
                                    <i class="far fa-paper-plane fa-3x" style="margin-top: 40%; margin-right: 10%;" aria-hidden="true"></i>
                                </span>
                    </a>
                </div>
            </div>

            <div class="column" style="width: 900px" v-else>

                    <!--<h2 style="width: fit-content;color: #d73c38;">{{this.idColation}}</h2>-->

                    <figure style="margin-top: 5%">
                        <img class="image is-2by3" style="width: auto; height: auto; margin: auto; margin-top: 15%;" src="/clubeatacado/css\img\intro_2.png" alt="ilu_1">
                    </figure>

            </div>
        </div>
        <div class="columns" v-else>
            <div class="column" style="width: 900px">
                <p class="subtitle is-prata is-3 has-text-centered">Você não tem nenhuma<br>Conversa</p>

                <figure style="margin-top: 5%">
                    <img class="image is-2by3" style="width: auto; height: auto; margin: auto; margin-top: 15%;" src="/clubeatacado/css\img\intro_2.png" alt="ilu_1">
                </figure>

            </div>
        </div>
        </div>
</template>

<script>
    import Firebase from 'firebase'

    let config = {
        apiKey: "AIzaSyC807CP7SpcEWsRJJztnJmfO8tAxvoCpn8",
        authDomain: "clubedoatacado-c43da.firebaseapp.com",
        databaseURL: "https://clubedoatacado-c43da.firebaseio.com",
        projectId: "clubedoatacado-c43da",
        storageBucket: "clubedoatacado-c43da.appspot.com",
        messagingSenderId: "838392935834",
    };

    let app = Firebase.initializeApp(config);
    let db = app.database();
    let msgRef = db.ref('message');

    export default {
        name: 'NewMessage',
        props: ['list'],
        data() {
            return {
                newMessage: null,
                itensList: '',
                feedback: null,
                userReceiverId: '',
                newChat: {},
                messages: [],
                name: '',
                child: '',
                idreceiver: 0,
                foto:'',
                sender: 0,
                urlpath: window.location.pathname,
                id: localStorage.getItem('id_anunciante'),
                usuarioLogin:0,
                star:0

            }
        },
        mounted(){
            this.itensList = this.list;
            console.log(this.itensList );
           
            this.id = localStorage.getItem('id_anunciante');
            if(this.id){
                axios.get('/clubeatacado/usuario/chat/' + this.id).then(res => {
                    console.log(res.data);
                    $('#nomeanunciante').text(res.data[0].nome);
                    
                    this.foto = res.data[0].foto;
                    this.usuarioLogin = res.data[0].usuarioLogin;
                    this.star = res.data[0].review[0].avaliacao;

                    if (this.usuarioLogin < this.id) {
                        this.child = this.usuarioLogin + "_" + this.id;
                    } else {
                        this.child = this.id + "_" + this.usuarioLogin;
                    }

                    this.idreceiver = res.data[0].idComprador;
                    
                    msgRef.child(this.child).on('child_added', (data) => {
                        console.log(data.val());
                        this.messages.push({
                            content: data.val().chatMessage,
                            senderId: data.val().senderId,
                            chatId: data.val().chatId,
                            receiverId: data.val().receiverId,
                            usuarioLogin: this.usuarioLogin
                        });

                        if(data.val().senderId === this.usuarioLogin ){
                            this.sender =   data.val().receiverId;
                            //   console.log(this.messages);
                        }else{
                            this.sender =  data.val().senderId;
                        }

                    });
                });

            }

        },
        methods: {

            addMessage() {
              
                if (this.newMessage) {
                    //this.id = localStorage.getItem('id_anunciante');
                    
                    if (this.child !== '') {
                       
                        // if (this.usuarioLogin > this.id) {
                        //     this.child = this.id + "_" +this.usuarioLogin;
                        // } else {
                        //     this.child = this.usuarioLogin + "_" + this.id;
                        // }
                        this.idAnuncio = localStorage.getItem('ID_ANUNCIO_PRODUTO');
                        this.input = [
                            this.usuarioLogin,
                            this.id,
                            this.child,
                            this.idAnuncio
                        ];
                        console.log(this.input);
                        axios.post('/clubeatacado/usuario/chat/novo', {
                            input: this.input

                        })
                            .then(response => {
                                console.log(response)

                            })
                            .catch(e => {
                                console.log('deu erro');
                            });
                        
                        
                        let ref = msgRef.child(this.child);
                        ref.push({
                            senderId: this.usuarioLogin,
                            chatId: this.child,
                            chatMessage: this.newMessage,
                            timestamp: Firebase.database.ServerValue.TIMESTAMP,
                            receiverId: this.idreceiver
                        });
                       
                        
                        this.newMessage = null;
                        this.feedback = null;
                    }
                    axios.post('/clubeatacado/usuario/chat/notification', {
                        input:  this.newChat

                    })
                        .then(response => {
                            console.log(response);
                        })
                        .catch(e => {
                            console.log('deu erro');
                        });
                } else {
                    this.feedback = "Escreva uma mensagem"

                }
            },
            showMessage(colletctionId, nome, usuarioId, foto, usuarioLogin, review) {
                //localStorage.setItem('id_anunciante', usuarioId);
                localStorage.setItem('usuarioLogin', usuarioLogin);
                this.usuarioLogin = usuarioLogin;
                this.id = usuarioId;
                this.idreceiver = usuarioId
                this.messages = [];
                this.star = review[0].avaliacao;
                this.child = colletctionId;
                msgRef.child(colletctionId).off();
                msgRef.child(colletctionId).on('child_added', (data) => {
                  
                    this.messages.push({
                        content: data.val().chatMessage,
                        senderId: data.val().senderId,
                        chatId: data.val().chatId,
                        receiverId: data.val().receiverId,
                        usuarioLogin: usuarioLogin
                    });

                    if(data.val().senderId === usuarioLogin){
                        this.sender =   data.val().receiverId;
                    }else{
                        this.sender =  data.val().senderId;
                    }
                    console.log(this.messages);
                    $('#nomeanunciante').text(nome);
                    $("#imagemanunciante").attr('src', foto);
                    this.foto =foto;
                });

            },
            removeMessage(){
                axios.post('/clubeatacado/usuario/chat/delete', {
                    input: this.child

                }).then(res => {
                    if(res.data !== 0 ){
                        localStorage.setItem('id_anunciante', null);
                        localStorage.setItem('ID_ANUNCIO_PRODUTO', null);
                        window.open(this.urlpath,'_self')
                    }

                });
            }

        },
    }
</script>
