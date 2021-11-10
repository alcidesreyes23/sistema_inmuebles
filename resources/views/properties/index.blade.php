@extends('layouts.plantilla')

@section('title','Registro Ciudadanos')

@section('content')

    <div id="categorie-table" class="modal-body table-responsive">

    </div>
    <a href="{{route('properties.index2')}}" id="enviar"class="btn  btn-info text-white">
        <i class="ti-home"></i>
      </a>


@endsection

@section('js')
<script>
      $(document).ready(function () {
            listado();
    });



    function listado() {
    var id = 1;
    $.ajax({
        url: "/properties/cargarDetalle/"  + id,
        dataType: "json",
        success: function (data) {
            console.log(data);
          /* html = "<table class='table table-striped' id='tablafiltro' width='100%'><thead>";
            html += "<tr><th scope='col'>NOMBRES</th><th scope='col'>APELLIDOS</th><th scope='col'>GÉNERO</th>";
            html += "<th scope='col'>DUI</th><th scope='col'>NIT</th><th scope='col'>NACIMIENTO</th>";
            html += "<th scope='col'>EDAD</th><th scope='col'>PROPIETARIO</th><th scope='col'>ACCIONES</th></tr></thead>";
            html += "<tbody>";
            //var tbody = "<tbody>";
            for (var key in data) {
                html += "<tr>";
                html += "<td>" + data[key]['nombres'] + "</td>";
                html += "<td>" + data[key]['apellidos'] + "</td>";
                html += "<td>" + data[key]['genero'] + "</td>";
                html += "<td>" + data[key]['dui'] + "</td>";
                html += "<td>" + data[key]['nit'] + "</td>";
                html += "<td>" + data[key]['fecha_nacimiento'] + "</td>";
                html += "<td>" + data[key]['edad'] + "</td>";
                html += "<td>" + data[key]['posee_inmueble'] + "</td>";
                html += `<td>
                <a href="<?php echo "hola como estan"; ?>" id="enviar" value="${data[key]['id']}" class="btn  btn-info text-white">
                  <i class="ti-home"></i>
                </a>`;
                
                html += `</td>`;
            }
            html += "</tr></tbody></table>"
            $("#categorie-table").html(html);*/
            //tabla filtro
            $('#tablafiltro').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
        }
    });
}
</script>

@endsection
