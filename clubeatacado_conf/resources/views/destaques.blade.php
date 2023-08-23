@extends('layouts.topo')

@section('content')
    <destaque v-bind:promocoes="{{$promocoes}}"></destaque>

@endsection
