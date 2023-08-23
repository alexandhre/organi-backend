@extends('layouts.topo')

@section('content')



    <!--------------------------------------FILTRO--------------->
    <tipocategoria v-bind:categorias="{{$categorias}}" v-bind:cores="{{$cores}}" :sub="{{$subCat}}"></tipocategoria>
@endsection
