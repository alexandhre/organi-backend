@extends('layouts.app')

@section('content')
<categoria v-bind:list="{{$showAllCategorias}}"></categoria>
@endsection
