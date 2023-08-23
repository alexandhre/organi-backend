@extends('layouts.topo')

@section('content')


    <!--------------------------------------breadcrumb--------------->
    <section class="section">

        <produtodetalhe v-bind:id="{{$id}}" ></produtodetalhe>
    </section>
@endsection