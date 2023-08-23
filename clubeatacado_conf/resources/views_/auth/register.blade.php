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
                        <?php
                        if (isset($validacao)) {
                            echo '<h1 style="text-align: center;">' . ' Cadastro validado com sucesso!' . '</h1>';;
                        }
                        ?>
                        <div class="container has-content-centered" style="padding-left: 0px;">

                            <div class="content">

                                <div class="card-image">
                                    <figure class="image">
                                        <img src="css/img/Tendering.png" style="height: 24px; width: 94px;" alt="Placeholder logo">
                                    </figure>
                                </div>

                                <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">

                                    <div class="field">
                                        <label>Nome</label>
                                        <input class="input" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;" value="{{ old('nome') }}" required autofocus placeholder="Nome" id="nome" type="text" name="nome">
                                        <span style="height: 24px; width: 24px;position:absolute;right:12px;top: 12%">
                                            <img src="css/img/ca-010-circle-account-user.png">
                                        </span>
                                    </div>
                                    <br>
                                    <div class="field">
                                        <label>E-mail</label>
                                        <input class="input" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;" value="{{ old('email') }}" required autofocus placeholder="E-mail" id="email" type="email" name="email">
                                        <span style="height: 24px; width: 24px;position:absolute;right:12px;top: 49%">
                                            <img src="css/img/atoms-icons-03-documents-email.png">
                                        </span>
                                    </div>
                                    <br>
                                    <div class="field">
                                        <label>Senha</label>
                                        <input class="input" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;" value="{{ old('senha') }}" required autofocus placeholder="Senha" id="senha" type="password" name="senha">
                                        <span style="height: 24px; width: 24px;position:absolute;right:3px;top: 90%">
                                            <div class="icon is-small" style="position: absolute; margin-left: -5%">
                                                <a onclick="showpassword('senha', 'eyeslashlogin', 'eyelogin')"><i class="fa fa-eye-slash" id="eyeslashlogin"></i></a>
                                                <a onclick="showpassword('senha', 'eyeslashlogin', 'eyelogin')"><i class="fa fa-eye" id="eyelogin" style="display: none"></i></a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="field">
                                    <label>Confirmar Senha</label>
                                    <input class="input" style="height:48px;padding: 12px 0 0 12px;border:1px solid #8f8f8f;border-radius:8px;" value="{{ old('confirmarSenha') }}" required autofocus placeholder="Confirmar Senha" id="confirmarSenha" type="password" name="confirmarSenha">
                                    <span style="height: 24px; width: 24px;position:absolute;right:12px;right: 32px;top: 92%;">
                                        <div class="icon is-small" style="position: absolute; margin-left: -5%">
                                            <a onclick="showpassword('confirmarSenha', 'confirmEyeslashlogin', 'confirmEyelogin')"><i class="fa fa-eye-slash" id="confirmEyeslashlogin"></i></a>
                                            <a onclick="showpassword('confirmarSenha', 'confirmEyeslashlogin', 'confirmEyelogin')"><i class="fa fa-eye" id="confirmEyelogin" style="display: none"></i></a>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="field">
                            <div class="control" style="font-size:14px;color:#444444">
                                <span style="height: 24px; width: 24px;">
                                    <input type="checkbox" id="termos" name="termos"> &nbsp Registrando, aceito as <a style="color: #17B330;" href="#">Termos
                                        de uso</a>.</span>
                                </span>

                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <div class="control" style="font-size:14px;color:#444444">
                                <span style="height: 24px; width: 24px;">
                                    <input type="checkbox" id="comprador" name="comprador" checked disabled> &nbsp Sou comprador.</span>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <div class="control" style="font-size:14px;color:#444444">
                                <span style="height: 24px; width: 24px;">
                                    <input type="checkbox" id="fornecedor" name="fornecedor"> &nbsp Sou fornecedor.</span>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="buttons has-addons is-centered">
                            <div class="control">
                                <button onclick="cadastrar()" class="button is-success" style="font-weight: bold;width:232px; height: 40px;">Registrar</button>
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