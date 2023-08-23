@extends('layouts.topo')

@section('content')


    @if("$_SERVER[REQUEST_URI]" === "/clubeatacado/anuncio/produto/page")
        <produtos></produtos>
    @else
        <todaspromocoes ></todaspromocoes>
    @endif

@endsection
