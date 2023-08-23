@include('layouts\_includes\topo')
@include('layouts\_includes\topoUsuario')

<body id="page-top">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id='wrapper'>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <section class="section">
                    <div class="container has-content-centered">
                        <?php
                        if (isset($validacao)) {
                            echo '<script>
                            success("Cadastro Realizado com sucesso!");
                            </script>';
                        }
                        ?>
                        <div class="container has-content-centered">

                            <div class="content">

                                <div class="card-image">
                                    <figure class="image">
                                        <img src="{{ asset('css/img/Tendering.png') }}" class="logo_login" alt="logo">
                                    </figure>
                                </div>

                                <div class="form-horizontal container col-xl-10 col-xxl-8 px-2 py-2">                                                                        
                                    <div class="col-md-10 mx-auto col-lg-8"> 
                                        <div class="card p-4" >

                                            <div class="field input_field">
                                                <div class="control has-icons-left">
                                                    <input class="input input_login"  value="{{ old('email') }}" required autofocus placeholder="E-mail" id="email" type="email" name="email">
                                                    <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>                                           
                                            </div>
                                         
                                           
                                                <div class="field input_field">
                                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="width: 95%; display: inline-flex">
                                                            <div class="control has-icons-left has-icons-right">
                                                                <input id="password" type="password"  placeholder="Senha" class="input input_login form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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

                                            <div class="field mt-2">
                                                @if (session('alert'))
                                                <div class="message is-warning" id="alerta">
                                                    <div class="message-header">
                                                        {{ session('alert') }}
                                                    </div>

                                                </div>
                                                @endif
                                                <div class="control" style="font-size:12pt;color:#868C99">
                                                    <label class="checkbox">
                                                        <a style="color: #23A7FB" href="/clubeatacado/recuperarSenha">Esqueci a minha senha</a>.
                                                    </label>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
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
                                        <button id="redirect-register" onclick="redirecionamento('registro')" class="button gradiente" style="font-weight: bold;width:232px; height: 40px; border: 1px solid green;">Registrar</button>
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