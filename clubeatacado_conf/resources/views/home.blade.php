@extends('layouts.topo')

@section('content')
    <categorias v-bind:categorias="{{$categorias}}"></categorias>

    <promocoes v-bind:promocoes="{{$promocoes}}"></promocoes>

    <exclusivos></exclusivos>
@endsection
