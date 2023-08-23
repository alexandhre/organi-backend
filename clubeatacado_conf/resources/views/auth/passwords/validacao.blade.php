@include('layouts\_includes\topo')
<body id="page-top">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id='wrapper'>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <section class="section">
                    <div class="container has-content-centered">
                        <div class="container has-content-centered">
                            <div class="content">
                                <div class="card-image">
                                    <figure class="image">
                                        <img src="{{ asset('css/img/Tendering.png') }}" class="logo_login" alt="logo">
                                    </figure>
                                </div>

                                <div class="container has-text-centered" style="height: 8em;position: relative;">
                                    <p class="titulos-1" style="width: 586px;font-size:32px;color:#1a1a1a;margin: 0;position: absolute;top: 50%;left: 50%;margin-right: -50%;transform: translate(-50%, -50%);">Cadastro realizado com sucesso!</p>
                                    <p class="textos-1" style="width:620px;font-size:18px;margin: 0;position: absolute;top: 95%;left: 50%;margin-right: -50%;transform: translate(-50%, -50%);">Para ativar a conta, é necessário clicar no link enviado por e-mail.</p><br>
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