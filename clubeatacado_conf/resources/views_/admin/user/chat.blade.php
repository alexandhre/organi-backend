@extends('layouts.topo')

@section('content')
    <!--------------------------------------FILTRO--------------->
    <section class="section">

        <div class="container has-text-centered">

            <div class="columns">
                <menusuario></menusuario>
                <chat v-bind:list="{{$usuario}}"></chat>

            </div>
        </div>
    </section>

@endsection


