@extends('layouts.master')
 
@section('content')
@section('head')
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <style>
  #draggable { 	height:115px;
	padding:10px 10px 10px 10px;
	width:115px;cursor:move;}
  #containment { 
	border:1px solid #000;
	height:400px;
	margin: 0px auto auto auto;
	position:relative;
	width:800px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;}
  h3 { clear: left; }
  </style>
  </style>
@stop
<div id="containment">
<div id="draggable" style="left:{{$coord->x_pos}}px; top:{{$coord->y_pos}}px;" class="ui-widget-content">
{{ HTML::image('images/table.png') }}
</div>
</div>
 
 <script>
  $(function() {
    $( "#draggable" ).draggable
    ({ containment: "#containment", scroll: false }).mouseup(
    				function(){
						var coord = $(this).position();					
						$.post("savepos/" + coord.left + "/" + coord.top, 
            				function(data){
                			if (data.success != true){
                  				alert('Error');
                			}else{
                				alert(data.message);
                }
            });  
					});
  });
  </script>
@stop