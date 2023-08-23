@include('layouts\_includes\topo')
@include('layouts\_includes\topoUsuario')


<body id="page-top">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id='wrapper' class="col-md-12">
        <div id="content-wrapper">
            <div id="content">
                <section class="section" style="height: 800px;">
                    <div class="container has-content-centered">
                        <?php
                        if (isset($validacao)) {
                            echo '<h1 style="text-align: center;">' . ' Cadastro validado com sucesso!' . '</h1>';;
                        }
                        ?>
                        <div class="container has-content-centered" style="padding-left: 0px;">

                            <div class="content">

                                <div class="card-image">
                                    <figure class="image">
                                        <img src="css/img/Tendering.png"  class="logo_login" alt=" logo">
                                    </figure>
                                </div>

                                <div class="card p-4 mb-3" >

                                    <div class="field">
                                        <label>Nome</label>
                                        <input class="input" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;" value="{{ old('nome') }}" required autofocus placeholder="Nome" id="nome" type="text" name="nome">
                                        <span class="icon-input" >
                                          <!--<img src="css/img/ca-010-circle-account-user.png"> -->  
                                          <i class="far fa-user-circle"></i>
                                        </span>
                                    </div>
                               
                                    <div class="field">
                                        <label>E-mail</label>
                                        <input class="input" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;" value="{{ old('email') }}" required autofocus placeholder="E-mail" id="email" type="email" name="email">
                                        <span class="icon-input">
                                            <i class="far fa-envelope"></i>
                                           <!--  <img src="css/img/atoms-icons-03-documents-email.png">-->
                                        </span>
                                    </div>
                              
                                    <div class="field">
                                        <label>Senha</label>
                                        <input class="input" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;" value="{{ old('senha') }}" required autofocus placeholder="Senha" id="senha" type="password" name="senha">
                                        <span class="icon-input">
                                            <div class="icon is-small" style="position: absolute; margin-left: -5%">
                                                <a onclick="showpassword('senha', 'eyeslashlogin', 'eyelogin')"><i class="fa fa-eye-slash" id="eyeslashlogin" style="margin-top:15px;"></i></a>
                                                <a onclick="showpassword('senha', 'eyeslashlogin', 'eyelogin')"><i class="fa fa-eye" id="eyelogin" style="display: none; margin-top:15px;"></i></a>
                                            </div>
                                        </span>
                                    </div>
                              
                               
                                <div class="field">
                                    <label>Confirmar Senha</label>
                                    <input class="input" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;" value="{{ old('confirmarSenha') }}" required autofocus placeholder="Confirmar Senha" id="confirmarSenha" type="password" name="confirmarSenha">
                                    <span class="icon-input">
                                        <div class="icon is-small" style="position: absolute; margin-left: -5%">
                                            <a onclick="showpassword('confirmarSenha', 'confirmEyeslashlogin', 'confirmEyelogin')"><i class="fa fa-eye-slash" id="confirmEyeslashlogin" style="margin-top:15px;"></i></a>
                                            <a onclick="showpassword('confirmarSenha', 'confirmEyeslashlogin', 'confirmEyelogin')"><i class="fa fa-eye" id="confirmEyelogin" style="display: none; margin-top:15px;"></i></a>
                                        </div>
                                    </span>
                                </div>
                           
                      
                         

                        <div class="field">
                            <div class="control" style="font-size:14px;color:#444444">
                                <span style="height: 24px; width: 24px;">
                                    <input type="checkbox" id="termos" name="termos"> &nbsp Registrando, aceito as <a style="color: #17B330;" href="#">Termos
                                        de uso</a>.</span>
                                </span>

                            </div>
                        </div>
                        
                        <div class="field">
                            <div class="control" style="font-size:14px;color:#444444">
                                <span style="height: 24px; width: 24px;">
                                    <input type="checkbox" id="comprador" name="comprador" checked disabled> &nbsp Sou comprador.</span>
                                </span>
                            </div>
                        </div>
                        
                        <div class="field">
                            <div class="control" style="font-size:14px;color:#444444">
                                <span style="height: 24px; width: 24px;">
                                    <input type="checkbox" id="fornecedor" name="fornecedor"> &nbsp Sou fornecedor.</span>
                                </span>
                            </div>
                        </div>
                        </div><!--card-->    
                        <div class="buttons has-addons is-centered">
                            <div class="control">
                                <button onclick="cadastrar()" class="button is-success" style="font-weight: bold;width:232px; height: 40px;">Registrar</button>
                            </div>
                        </div>
                        <div class="buttons has-addons is-centered">
                            <div class="control">
                                <button onclick="redirecionamento('login')" class="button gradiente" style="font-weight: bold;width:232px; height: 40px; border: 1px solid green;">Já estou
                                    registrado</button>
                            </div>
                        </div>
                      
                    </div>

                    </div>
            </div>
        </div>
        </section>

    </div>
    </div>
    @include('layouts\_includes\footer')
    </div>
</body>