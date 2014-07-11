@extends('layouts.master')

@section('content')
@section('head')
<script type="text/javascript">
$(document).ready(function ()
{
$("#table").load('listres');
});
</script>
@stop
<h1> Reservas </h1>
<p> {{ link_to ('reservas/create', 'Crear nueva Reserva') }} </p>
<div class='errors_form'></div>
<div id='table'>

</div>
@stop
