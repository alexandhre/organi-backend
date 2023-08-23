@extends('layouts.topo')

@section('content')



    <section class="section">

        <div class="container has-text-centered">
            <p class="subtitle is-carvao is-5 has-text-left">Esmoda Lmtda.</p>
        <div class="columns">

        <menusuario></menusuario>
        <meuproduto v-bind:anuncios="{{$anuncio}}"></meuproduto>

        </div>
        </div>
    </section>
@endsection
