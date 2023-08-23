@extends('layouts.topo')

@section('content')
    <section class="section">

        <div class="container has-text-centered">
            <div class="columns" >
                <menusuario></menusuario>

                <!--------------------------------------FILTRO--------------->
                <editarperfil v-bind:list="{{$listaUsers}}"></editarperfil>

            </div>
        </div>
    </section>
@endsection
