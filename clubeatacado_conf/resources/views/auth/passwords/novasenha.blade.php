@extends('layouts.topo')

@section('content')
    <section class="section">

        <div class="container has-content-centered">
            <p class="subtitle is-prata is-3 has-text-centered">Recuperar a senha</p>
            <p class="subtitle is-8 has-text-left" style="line-height: 20px;color:#525763; width: 328px; margin-left: 350px">Introduza o e-mail que você se registrou e nós enviaremos
                um enlace para que você possa mudar a sua senha. Não te enviaremos a senha antiga, porque nosso sistema está
                encriptado e não temos acesso a sua informação privada.
                A segurança da sua informação, em primeiro lugar!</p>
            <div class="columns">
                <div class="column is-5 is-offset-one-quarter" style="margin-left: 350px;">
                    <div class="card" style="box-shadow: 0 0px 0px rgba(10, 10, 10, 0.1), 0 0 0 0px rgba(10, 10, 10, 0.1);">

                        <div class="card-content">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="form-horizontal" method="POST" action="{{ route('recuperasenha') }}">
                                {{ csrf_field() }}
                                <div class="field" style="width: 290px; border-style: solid; border-width: 0px 0px 1px 0px; color: #dbdbdb">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <p class="control has-icons-left">
                                            <input class="input" type="email" id="email" placeholder="Email" name="email"
                                                   value="{{ old('email') }}" required style="box-shadow:inset 0 0px 0px #ffffff00;border-color:#ffffff00;padding-left: 50px;font-size: 14px;">
                                            <span class="icon is-small is-left" style="height: 27px; width: 20px">
                                              <i class="fas fa-envelope"></i>
                                        </span>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    </p>
                                </div>
                                <div class="notification is-success" style="display: {{(isset($senha))?"block":"none"}}; width:290px;">
                                    <span id="texto">Uma nova senha foi enviada ao seu email</span>
                                </div>

                                <div class="buttons has-addons is-centered">
                                    <div class="control">
                                        <button  type="submit" class="button" style="color:#525763;font-weight: bold;width:290px; height: 52px;margin-inline-end: 80px;">Recuperar senha</button>
                                    </div>
                                </div>


                            </form>

                            <br>

                            <div class="buttons has-addons is-centered">
                                <div class="control">
                                    <button class="button gradiente" style="color:#525763;background-color:#FFFFFF;box-shadow:2px 2px #A8ABB1, 0px 0px 0 2px #A8ABB1; width:290px; height: 52px;margin-inline-end: 80px;" href="/login">Regressar ao login</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
<style>
    #texto {
        text-align: center;
    }
</style>
{{--<script>--}}
    {{--$(document).on('click', '.notification > button.delete', function () {--}}
        {{--$(this).parent().addClass('is-hidden');--}}
        {{--return false;--}}
    {{--});--}}
{{--</script>--}}