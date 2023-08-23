@include('layouts\_includes\topo')
@include('layouts\_includes\topoUsuario')

<body id="page-top">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id='wrapper'>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <section class="section" >
                    <div class="container has-content-centered">
                        <h3 class="is-prata is-3 has-text-centered">Bem Vindo!</h3>
                        <?php
                        if (isset($validacao)) {
                            echo '<h1 style="text-align: center;">' . ' Cadastro validado com sucesso!' . '</h1>';;
                        }
                        ?>
                        <div class="container has-content-centered">
                            <div class="content">
                                <div class="card-image">
                                    <figure class="image">
                                        <img src="{{ asset('css/img/Tendering.png') }}" class="logo_login" alt="Tendering">
                                    </figure>
                                </div>


                                <div class="container col-xl-10 col-xxl-8 px-2 py-2">
                                    <div class="row align-items-center g-lg-5">                                  
                                    <div class="col-md-10 mx-auto col-lg-8">
                                        <form class="p-4 p-md-5 border rounded-3 bg-white">
                                            <div class="form-floating mb-3">
                                            <div class="field" style="padding: 25px 0 0;width: 290px; border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                            <div class="control has-icons-left">
                                                <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px;" value="{{ old('email') }}" required autofocus placeholder="E-mail" id="email2" type="email2" name="email2">
                                                <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>                                           
                                        </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                                <label for="floatingPassword">Password</label>
                                            </div>
                                            <div class="checkbox mb-3">
                                                <label>
                                                <input type="checkbox" value="remember-me"> Remember me
                                                </label>
                                            </div>
                                            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
                                            <hr class="my-4">
                                            <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
                                        </form>
                                    </div>
                                    </div>
                                </div>



                                <div class="form-horizontal">                                                                        

                                    <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);text-align: center;left: 35%;">

                                        <div class="field" style="padding: 25px 0 0;width: 290px; border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                            <div class="control has-icons-left">
                                                <input class="input" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px;" value="{{ old('email') }}" required autofocus placeholder="E-mail" id="email" type="email" name="email">
                                                <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>                                           
                                        </div>
                                        <br>
                                        <div class="form-group row" style="margin: 5% 0%;">
                                            <div class="col-md-6">
                                                <div class="field" style="width: 290px;border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="width: 95%; display: inline-flex">
                                                        <div class="control has-icons-left has-icons-right">
                                                            <input id="password" type="password" style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px; width: 100%;" placeholder="Senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                            <span class="icon is-small is-left" style="height: 27px; width: 20px; ">
                                                                <i class="fas fa-lock"></i>
                                                            </span>                                                           
                                                        </div>
                                                    </div>
                                                    <div class="icon is-small" style="position: absolute; margin-left: -5%">
                                                        <a onclick="showpassword('password', 'eyeslashlogin', 'eyelogin')"><i class="fa fa-eye-slash" id="eyeslashlogin"></i></a>
                                                        <a onclick="showpassword('password', 'eyeslashlogin', 'eyelogin')"><i class="fa fa-eye" id="eyelogin" style="display: none"></i></a>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="field">
                                            @if (session('alert'))
                                            <div class="message is-warning" id="alerta">
                                                <div class="message-header">
                                                    {{ session('alert') }}
                                                </div>

                                            </div>
                                            @endif
                                            <div class="control" style="font-size:12px;color:#868C99">
                                                <label class="checkbox">
                                                    <a style="color: #23A7FB" href="/clubeatacado/recuperarSenha">Esqueci a minha senha</a>.
                                                </label>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <br>
                                    <div class="buttons has-addons is-centered">
                                        <div class="control">
                                            <button onclick="login()" class="button is-success" style="font-weight: bold;width:232px; height: 40px;">Entrar</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="buttons has-addons is-centered">
                                    <div class="control">
                                        <button onclick="redirecionamento('registro')" class="button gradiente" style="font-weight: bold;width:232px; height: 40px;">Registrar</button>
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