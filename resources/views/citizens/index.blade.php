@extends('layouts.plantilla')

@section('title','Registro Ciudadanos')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Registro Ciudadano</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nuevo Ciudadano</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
       <div id="categorie-table" class="modal-body table-responsive">

       </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="container p-3">
        <form method="post" action="{{route('citizens.store')}}" id="miFormulario" >
          @csrf
          <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-6 my-2">
                <p class="text-muted text-gray">Nombres</p>
                  <input class="form-control" type="text" id="txtId" name="nombres" placeholder="Nombres" data-validetta="required">
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2">
                <p class="text-muted text-gray">Apellidos</p>
                <input class="form-control" type="text" id="txtId" name="apellidos" placeholder="Apellidos" data-validetta="required">
           </div>
           <div class="col-12 col-sm-12 col-md-6 my-2">
            <p class="text-muted text-gray">Género</p>
            <select name="genero" id="sGenero" class="form-control rounded-md shadow-sm mt-1 block w-full">
                  <option value="" selected>-- Género --</option>
                  <option value="Hombre">Hombre</option>
                  <option value="Mujer">Mujer</option>
              </select>
          </div> 
          <div class="col-12 col-sm-12 col-md-6 my-2">
            <p class="text-muted text-gray">Edad</p>
          <input class="form-control" type="number" id="txtId" name="edad" placeholder="Edad" data-validetta="required">
        </div> 
        <div class="col-12 col-sm-12 col-md-6 my-2">
            <p class="text-muted text-gray">Fecha Nacimiento</p>
            <input class="form-control" type="date" id="txtId" name="fecha_nacimiento" placeholder="NACIMIENTO" data-validetta="required">
        </div>    
           <div class="col-12 col-sm-12 col-md-6 my-2">
            <p class="text-muted text-gray">Número de Dui</p>
                <input class="form-control" type="text" id="txtId" name="dui" placeholder="DUI" data-validetta="required">
           </div>
           <div class="col-12 col-sm-12 col-md-6 my-2">
            <p class="text-muted text-gray">Número de Nit</p>
                <input class="form-control" type="text" id="txtId" name="nit" placeholder="NIT" data-validetta="required">
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2">
                <p class="text-muted text-gray">Posee Inmueble</p>
                <select name="posee_inmueble" id="sPropietario" class="form-control rounded-md shadow-sm mt-1 block w-full">
                      <option value="" selected>-- Propietario Inmueble --</option>
                      <option value="Si">Si</option>
                      <option value="No">No</option>
                  </select>
              </div>
            <div class="col-12 mt-1 text-center card-footer bg-transparent border-primary">
              <button class="btn btn-primary mt-2  btn-md" id="btnGuardar">Agregar</button>
            </div>
      </form>
      </div>
    </div>
  </div>
   <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                  <i class="fa fa-user"></i> Actualizar Informacion
              </h5>
          </div>
          <div class="modal-body">
              <form id="miFormulario2" method="POST">
                <div class="row">
                  @method('PUT')
                  @csrf
                      <input type="hidden" id="id" name="id">
                      <div class="col-12 col-sm-12 col-md-6 my-2">
                        <p class="text-muted text-gray">Nombres</p>
                          <input class="form-control" type="text" id="nombres" name="nombres" placeholder="Nombres" data-validetta="required">
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 my-2">
                        <p class="text-muted text-gray">Apellidos</p>
                        <input class="form-control" type="text" id="apellidos" name="apellidos" placeholder="Apellidos" data-validetta="required">
                   </div>
                   <div class="col-12 col-sm-12 col-md-6 my-2">
                    <p class="text-muted text-gray">Género</p>
                    <select name="genero" id="sGenero" class="form-control rounded-md shadow-sm mt-1 block w-full">
                          <option value="" selected>-- Género --</option>
                          <option value="Hombre">Hombre</option>
                          <option value="Mujer">Mujer</option>
                      </select>
                  </div> 
                  <div class="col-12 col-sm-12 col-md-6 my-2">
                    <p class="text-muted text-gray">Edad</p>
                  <input class="form-control" type="number" id="edad" name="edad" placeholder="Edad" data-validetta="required">
                </div> 
                <div class="col-12 col-sm-12 col-md-6 my-2">
                    <p class="text-muted text-gray">Fecha Nacimiento</p>
                    <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="NACIMIENTO" data-validetta="required">
                </div>    
                   <div class="col-12 col-sm-12 col-md-6 my-2">
                    <p class="text-muted text-gray">Número de Dui</p>
                        <input class="form-control" type="text" id="dui" name="dui" placeholder="DUI" data-validetta="required">
                   </div>
                   <div class="col-12 col-sm-12 col-md-6 my-2">
                    <p class="text-muted text-gray">Número de Nit</p>
                        <input class="form-control" type="text" id="nit" name="nit" placeholder="NIT" data-validetta="required">
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 my-2">
                        <p class="text-muted text-gray">Posee Inmueble</p>
                        <select name="posee_inmueble" id="sPropietario" class="form-control rounded-md shadow-sm mt-1 block w-full">
                              <option value="" selected>-- Propietario Inmueble --</option>
                              <option value="Si">Si</option>
                              <option value="No">No</option>
                          </select>
                      </div>
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  <i class="fa fa-times"></i> Close</button>
              <button type="button" class="btn btn-primary" id="btnActualizar">
                  <i class="fa fa-cloud-download-alt"></i> Guardar</button>
          </div>
      </div>
  </div>
</div>


@endsection

@section('js')
<script>
      $(document).ready(function () {
            listado();
    });

  $("#btnGuardar").click(function (e) {
  e.preventDefault()
        var form = $("#miFormulario")
        var method = form.attr('method')
        var action = form.attr('action')
        var data = form.serialize()
        $.ajax({
            type : method,
            url : action,
            dataType: "json",
            data : data,
            success: function(response){
                // console.log(response)
                var mensaje = (response)?'Registo guardado correctamente.':'Error al insertar registro';
                toastr.success(mensaje,'Nuevo Registro',{timeOut:4000});

                 // Actualizamos los datos de la DataTable sin Inicializar
                 listado();
            },
            error: function(){
                console.log('ERROR')
            }
        }) 

    });

      $("#btnActualizar").click(function (e) {
          var form = $("#miFormulario2")
          var data = form.serialize()
          $.ajax({
              type: "POST",
              url: "/citizens/update",
              dataType: "json",
              data:data,
              success: function (response) {
              if (response) {
                  toastr.success("Exito: Registro Actualizado", "Operacion Exitosa");
                  $("#exampleModal").modal("hide");
                  $("#miFormulario2")[0].reset();
                  listado();
              }
            
          },error: function(){
                  toastr.error("Error: Registro No Actualizado", "Operacion No Completada");
              }
          }) 

  });

    $(document).on("click", "#edit", function (e) {
        let idEditar = $(this).attr("value");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/citizens/edit/" + idEditar,
            success: function (r) {
                $("#exampleModal").modal("show");//abro el modal
                $("#id").val(r['id']);
                $("#nombres").val(r['nombres']);
                $("#apellidos").val(r['apellidos']);
                $("#edad").val(r['edad']);
                $("#dui").val(r['dui']);
                $("#nit").val(r['nit']);
                $("#fecha_nacimiento").val(r['fecha_nacimiento']);
                var genero = r['genero'];
                var posee_inmueble = r['posee_inmueble'];
                $("#sGenero option[value='"+ genero +"']").attr("selected",true);
                $("#sPropietario option[value='"+ posee_inmueble +"']").attr("selected",true);
            },
        });
        e.preventDefault();
    });


    $(document).on("click", "#del", function (e) {
    let idEliminar = $(this).attr("value");
    Swal.fire({
        title: 'Seguro desea eliminar?',
        text: "Solo se cambiara el estado del registro",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/citizens/delete/" + idEliminar,
                success: function (response) {
                    listado();
                }
            });
            toastr.error("Exito: Registro Eliminado", "Operacion Exitosa");
        }
    })
      e.preventDefault();
});

    function listado() {
    $.ajax({
        type: "GET",
        url: "/citizens/cargarDatos",
        dataType: "json",
        success: function (data) {
            html = "<table class='table table-striped' id='tablafiltro' width='100%'><thead>";
            html += "<tr><th scope='col'>NOMBRES</th><th scope='col'>APELLIDOS</th><th scope='col'>GÉNERO</th>";
            html += "<th scope='col'>DUI</th><th scope='col'>NIT</th><th scope='col'>NACIMIENTO</th>";
            html += "<th scope='col'>EDAD</th><th scope='col'>DUEÑO</th><th scope='col'>ACCIONES</th></tr></thead>";
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
                <a href="#" id="edit" value="${data[key]['id']}" class="btn  btn-warning text-white">
                    <i class="ti-pencil"></i>
                </a>
                <a href="#" id="del" value="${data[key]['id']}" class="btn  btn-danger text-white">
                  <i class="icon-trash"></i>
                </a>
                </td>`;

            }
            html += "</tr></tbody></table>"
            $("#categorie-table").html(html);
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
