@extends('layouts.master')
 
@section('sidebar')
     @parent
     Usuario
@stop
@section('content')
<h1> {{ $user->name }} </h1>
    <ul>
       <li> Nombre de usuario: {{ $user->name }} </li>
       <li> Email: {{ $user->lastname }} </li>
    </ul>
    <p> {{ link_to('users', 'Volver atrás') }} </p>
@stop