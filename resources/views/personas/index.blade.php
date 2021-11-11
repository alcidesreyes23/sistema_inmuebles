@extends('layouts.plantilla')

@section('title', 'Personas')

@section('css')
    <style>
        /*para alinear los botones y cuadro de busqueda*/
        .btn-group,
        .btn-group-vertical {
            position: absolute !important;
        }

    </style>

@endsection

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Lista Usuarios</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Nueva Usuario</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="categorie-table">

            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container p-5">
                <form method="post" action="{{ route('personas.store') }}" id="miFormulario">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Nombre de Usuario</p>
                            <input class="form-control" type="text" id="txtId" name="name" placeholder="Nombre">
                            <small id="nombreV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Email</p>
                            <input class="form-control" type="email" id="txtId" name="email" placeholder="Email">
                            <small id="emailV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Password</p>
                            <input class="form-control" type="password" id="txtId" name="password" placeholder="Password">
                            <small id="passV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Rol</p>
                            <select name="rol" id="sRol" class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Rol --</option>
                                <option value="Admin">Admin</option>
                                <option value="Castro">Castro</option>
                                <option value="Auxiliar">Auxiliar</option>
                            </select>
                            <small id="rolV" class="text-danger"></small>
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
                            <div class="col-12 col-sm-12 col-md-12 my-2">
                                <input class="form-control" type="text" id="name" name="name" placeholder="Nombre">
                                <small id="nombreV2" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 my-2">
                                <input class="form-control" type="email" id="email" name="email" placeholder="Email">
                                <small id="emailV2" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 my-2">
                                <select name="rol" id="sRol" class="form-control rounded-md shadow-sm mt-1 block w-full">
                                    <option value="" selected>-- Rol --</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Castro">Castro</option>
                                    <option value="Auxiliar">Auxiliar</option>
                                </select>
                                <small id="rolV2" class="text-danger"></small>
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
        $(document).ready(function() {
            listado();
        });

        $("#btnGuardar").click(function(e) {
            e.preventDefault()
            var form = $("#miFormulario")
            var method = form.attr('method')
            var action = form.attr('action')
            var data = form.serialize()
            $.ajax({
                type: method,
                url: action,
                dataType: "json",
                data: data,
                success: function(response) {
                    // console.log(response)
                    var mensaje = (response) ? 'Registo guardado correctamente.' :
                        'Error al insertar registro';
                    toastr.success(mensaje, 'Nuevo Registro', {
                        timeOut: 4000
                    });

                    // Actualizamos los datos de la DataTable sin Inicializar
                    listado();
                },
                error: function(res2) {
                    const errors = res2.responseJSON.errors;
                    (errors.name != undefined) ? $("#nombreV").text(`*${errors.name}`): $("#nombreV").hide();
                    (errors.email != undefined) ? $("#emailV").text(`*${errors.email}`): $("#emailV").hide();
                    (errors.password != undefined) ? $("#passV").text(`*${errors.password}`): $("#passV").hide();
                    (errors.rol != undefined) ? $("#rolV").text(`*${errors.rol}`): $("#rolV").hide();
                }
            })

        });

        $("#btnActualizar").click(function(e) {
            var form = $("#miFormulario2")
            var data = form.serialize()
            $.ajax({
                type: "POST",
                url: "/personas/update",
                dataType: "json",
                data: data,
                success: function(response) {
                    if (response) {
                        toastr.success("Exito: Registro Actualizado", "Operacion Exitosa");
                        $("#exampleModal").modal("hide");
                        $("#miFormulario2")[0].reset();
                        listado();
                    }

                },
                error: function(res) {
                    
                }
            })

        });

        $(document).on("click", "#edit", function(e) {
            let idEditar = $(this).attr("value");
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/personas/edit/" + idEditar,
                success: function(r) {
                    $("#exampleModal").modal("show"); //abro el modal
                    $("#id").val(r['id']);
                    $("#name").val(r['name']);
                    $("#email").val(r['email']);
                    var rol = r['rol'];
                    $("#sRol option[value='" + rol + "']").attr("selected", true);

                    // $("#sRol option[value="r['rol']"]").attr("selected",true);
                },
            });
            e.preventDefault();
        });

        $(document).on("click", "#del", function(e) {
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
                        url: "/personas/delete/" + idEliminar,
                        success: function(response) {
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
                url: "/personas/cargarDatos",
                dataType: "json",
                success: function(data) {
                    html =
                        "<table class='table table-striped' id='tablafiltro' width='100%' cellspacing='0'><thead>";
                    html += "<tr><th scope='col'>ID</th><th scope='col'>NOMBRE</th><th scope='col'>EMAIL</th>";
                    html += "<th scope='col'>ROL</th><th scope='col'>Acciones</th></tr></thead>";
                    html += "<tbody>";
                    //var tbody = "<tbody>";
                    for (var key in data) {
                        html += "<tr>";
                        html += "<td>" + data[key]['id'] + "</td>";
                        html += "<td>" + data[key]['name'] + "</td>";
                        html += "<td>" + data[key]['email'] + "</td>";
                        html += "<td>" + data[key]['rol'] + "</td>";
                        html += `<td>
                                    <a href="#" id="edit" value="${data[key]['id']}" class="btn  btn-warning">
                                    Editar
                                    </a>
                                    <a href="#" id="del" value="${data[key]['id']}" class="btn  btn-danger">
                                    Eliminar
                                    </a>
                                    </td>`;
                    }
                    html += "</tr></tbody></table>"
                    $("#categorie-table").html(html);
                    $('#tablafiltro').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                        },
                        /*Reportes Data Table*/
                        dom: 'Bfrtilp',
                        buttons: [{
                                extend: 'excelHtml5',
                                text: '<i class="fas fa-file-excel"></i> ',
                                titleAttr: 'Exportar a Excel',
                                className: 'btn btn-sm btn-success'
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fas fa-file-pdf"></i> ',
                                titleAttr: 'Exportar a PDF',
                                className: 'btn btn-sm btn-danger',
                                exportOptions: {
                                    columns: [0, 1, 2, 3]
                                }
                            },
                            {
                                extend: 'print',
                                text: '<i class="fa fa-print"></i> ',
                                titleAttr: 'Imprimir',
                                className: 'btn btn-sm btn-info'
                            },


                        ],

                        /*End Reportes Data Table*/


                    });
                }
            });
        }
    </script>

@endsection
