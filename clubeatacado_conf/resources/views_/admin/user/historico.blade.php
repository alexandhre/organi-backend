@extends('layouts.topo')

@section('content')



    <section class="section">

        <div class="container has-text-centered">
            <p class="subtitle is-carvao is-5 has-text-left">Esmoda Lmtda.</p>
            <div class="columns">

                <menusuario></menusuario>
                <historico v-bind:anuncios="{{$pedidos}}"></historico>

            </div>
        </div>
    </section>
@endsection
{{--<script>--}}
    {{--import Historico from "../../../assets/js/components/Historico";--}}
    {{--export default {--}}
        {{--components: {Historico}--}}
    {{--}--}}
{{--</script>--}}