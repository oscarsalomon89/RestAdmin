@extends('layouts.master')
 
@section('content')
@section('head')
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <style>
  .draggable
  { 	
  height:110px;
	width:130px;
  position: absolute;
}

  #containment-wrapper { 
  border:1px solid #000;
  height:700px;
  position:relative;
  width:800px;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
}
  </style>
@stop
<div id="containment-wrapper">
@foreach($coords as $coord)
<div id='table_select' value='{{$coord->table_id}}' class="draggable" style="left:{{$coord->x_pos}}px; top:{{$coord->y_pos}}px;">
{{ HTML::image('images/table.png') }}
</div>
@endforeach
</div>

 
<script>
  
  </script>
@stop