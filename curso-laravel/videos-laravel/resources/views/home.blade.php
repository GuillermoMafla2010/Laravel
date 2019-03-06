@extends('layouts.app')

@section('content')
    @if(session('message'))
        <div class="alert alert-success">
            {{session("message")}}
        </div>
    @endif

<h2>Terminos de la Busqueda : {{$search}}</h2>

@include('video.videolist')


@endsection
