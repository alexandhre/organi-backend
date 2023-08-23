@include('layouts\_includes\topo')
@include('layouts\_includes\topoUsuario')

<body id="page-top">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id='wrapper'>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <section class="section" style="height: 733px;">
                    <div class="container has-content-centered">
                        <p class="subtitle is-prata is-3 has-text-centered">Bem Vindo!</p>                        
                        <div class="container has-content-centered">

                            <div class="content">

                                <div class="card-image">
                                    <figure class="image">
                                        <img src="css/img/Tendering.png" style="height: 24px; width: 94px;" alt="Logo">
                                    </figure>
                                </div>
                                
                                <div class="form-horizontal container col-xl-10 col-xxl-8 px-2 py-2">                                                                        
                                    <div class="col-md-10 mx-auto col-lg-8"> 
                                        <div class="card p-4" >                                 
                                          <div class="field  input_field" >
                                            <div class="control has-icons-left">
                                                <input class="input input_login"  value="{{ old('email') }}" required autofocus placeholder="E-mail" id="email" type="email" name="email">
                                                <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>                                         
                                           </div> 
                                           
                                           <div class="buttons has-addons is-centered">
                                            <div class="control">
                                                <button onclick="resetarSenha()" class="button is-success" style="font-weight: bold;width:232px; height: 40px;">Enviar</button>
                                            </div>
                                        </div>                              
                                        <div class="buttons has-addons is-centered">
                                            <div class="control">
                                                <button onclick="redirecionamento('login')" class="button gradiente" style="font-weight: bold;width:232px; height: 40px;">Já estou
                                                    registrado</button>
                                            </div>
                                        </div>
                                       </div>
                                   </div>                                      
                               </div>
                       
                              
                                <br>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        @include('layouts\_includes\footer')
    </div>
</body>