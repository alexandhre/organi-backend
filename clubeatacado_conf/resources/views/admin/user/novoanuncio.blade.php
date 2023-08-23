@extends('layouts.topo')

@section('content')
    <section class="section">

        <div class="container has-text-centered">
            <p class="subtitle is-carvao is-5 has-text-left">Esmoda Lmtda.</p>
            <div class="columns">

                <menusuario></menusuario>
                <anuncie :Produto='<?php echo json_encode($qtProduto); ?>'></anuncie>

            </div>
        </div>
    </section>

<?php
    if(isset($end)){
        echo " <script language=javascript>
                    alert( 'Você precisa cadastrar seus dados de Atacadista para subir um anúncio!' );
                    window.location.href='/clubeatacado/usuario/userdetail';
                    </script>";

    }
?>
@endsection