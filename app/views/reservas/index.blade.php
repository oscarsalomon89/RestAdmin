@extends('layouts.master')
 @section('head')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
@stop

@section('content')
    @if(Session::has('notice'))
       <div class="alert alert-success">{{ Session::get('notice') }}</div>
    @endif
<h1> Reservas </h1>
<div id="dialog-form" title="Crear nueva reserva">
<div class='modal-body'>
  <p class="validateTips">Completar los siguientes campos.</p>
<!--en este los errores del formulario--> 
<div class='errors_form'></div>
{{ Form::open(array('url' => 'reservas/'.$reserva->id, 'id' => 'form')) }}
    <div class="form-group">
       {{ Form::label ('date', 'Fecha') }}
       <input type="date" name='date' class='form-control'>
    </div>
    <div class="form-group">
       {{ Form::label ('name', 'Nombre') }}
       {{ Form::text ('name', $reserva->name, array('class'=>'form-control','placeholder'=>'Nombre', 'autocomplete'=>'of')) }} 
     </div> 
       <div class="form-group">
       {{ Form::label ('cantpersons', 'Cantidad de personas') }}
       {{ Form::text ('cantpersons', $reserva->cantpersons, array('class'=>'form-control','placeholder'=>'Cantidad de personas', 'autocomplete'=>'of')) }} 
     </div>
      <br>
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" class="btn btn-success">
{{ Form::close() }}
</div>
</div>
<!--en este el mensaje de registro correcto-->
<div class='success_message alert-box success'></div>
<br>
<button id="create-reserva" class="btn btn-primary">Crear nueva reserva</button>
<br>
<div id="tabla">

</div>
<script type="text/javascript">
$(document).ready(function() {

$("#tabla").load('listres');
$( "#datepicker" ).datepicker();
var form = $('#form'), dialog;

$( "#create-reserva" ).button().on( "click", function() {
      dialog.dialog( "open" );
    }); 

$('#edit-reserva').click(function(){
var id=$(this).attr('data-id');
        $('.modal-body').load('index.php', params,function(){
            $("#myModal").modal('show');
            $('#myModalLabel').text("Editar Mesa");
        });
dialog.dialog( "open" );
    });
form.bind('submit', function () {
         $.ajax({
           type: form.attr('method'),
           dataType: "json",
           url: form.attr('action'),
           data: form.serialize(),
           success: function (data)
                  {
                  if(data.success == false){
                        var errores = '';
                        for(datos in data.errors){
                            errores += data.errors[datos] + '<br>';
                        }
                        $('#dialog-form .success_message').html("");
                        $('.errors_form').html(errores);
                    }else{
                        $(form)[0].reset();//limpiamos el formulario
                        $('.errors_form').html("");
                        dialog.dialog( "close" );
                          mensaje = '<small class="alert alert-success">' + data.message + '</small>';
                        $('.success_message').html(mensaje);
                        $("#tabla").load('listres');
                    }
                  }
         });
  return false;
    });
 
dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 550,
      modal: true,
      close: function() {
        form[ 0 ].reset();
        $('.errors_form').html("");
        $('#dialog-form .success_message').html("");
      }
    });
  });
</script>
@stop