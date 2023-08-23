
@extends('layouts.topo')

@section('content')

    <!---------------------CATEGORIAS--------------->

   <todascategorias v-bind:categorias="{{$categorias}}"></todascategorias>
@endsection
