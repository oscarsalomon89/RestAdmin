<script type="text/javascript">
$(document).ready(function ()
{
var form = $('#formulario_delete');
form.bind('submit', function () {
  $.ajax({
           type: form.attr('method'),
           dataType: "json",
           url: form.attr('action'),
           data: form.serialize(),
           success: function (data)
                  {
                  if(data.success == true){
                    $(form)[0].reset();//limpiamos el formulario
                    $('.errors_form').addClass( "alert alert-danger error" );
                        $('.errors_form').html(data.message);
                        $("#table").load('listres');
                    }
                  }
         }); 
  return false;
});
/*setInterval("actualizar()",1000);
});
function actualizar() {
$("#table").load('listres');
}*/
});
</script>
<div class="widget-content-white glossed">
    <div class="padded">
          <table class="table table-striped table-bordered table-hover datatable">
          <thead>
          <tr>
             <th> Fecha </th>
             <th> Nombre </th>
             <th> Cantidad de personas </th>
          </tr>
          </thead>
          <tbody>
          @foreach($reservas as $reserva)
             <tr>
                <td> {{ $reserva->date }} </td>
                <td> {{ $reserva->name }} </td>
                <td> {{ $reserva->cantpersons }} </td>
                <td> <a href = 'reservas/{{$reserva->id}}/edit' class="btn btn-default btn-xs">Editar</a> </td>
                <td> {{ Form::open(array('url' => 'reservas', 'id' => 'formulario_delete')) }}
        <input type="hidden" id= 'reserva_id' name="reserva_id" value='{{$reserva->id}}'>
        {{ Form::submit('Eliminar', array('class' => 'btn btn-primary btn-xs')) }}       
        {{ Form::close() }} </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>