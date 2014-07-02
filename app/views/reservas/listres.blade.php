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
                <td> {{ $reserva->cantPersons }} </td>
                <td> <button id="edit-reserva" class="btn btn-default btn-xs">Editar</button> </td>
                <td> {{ link_to('reservas/'.$reserva->id.'/delete', 'Eliminar') }} </td>
             </tr>
          @endforeach
          </tbody>
       </table>
</div>
</div>