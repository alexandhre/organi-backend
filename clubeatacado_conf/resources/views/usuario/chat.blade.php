@extends('layouts.top')

@section('content')
    <chat :list="{{$usuario}}"></chat>

@endsection