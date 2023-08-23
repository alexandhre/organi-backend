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
                                        <img src="css/img/Tendering.png" style="height: 24px; width: 94px;" alt="Placeholder logo">
                                    </figure>
                                </div>
                                    <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);left: 35%;">
                                        <div class="field" style="padding: 25px 0 0;width: 290px; border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                            <div class="control has-icons-left">
                                                <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px;" value="{{ old('email') }}" required autofocus placeholder="E-mail" id="email" type="email" name="email">
                                                <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>                                         
                                        </div>
                                        <br>
                                    </div>
                                    <br>
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