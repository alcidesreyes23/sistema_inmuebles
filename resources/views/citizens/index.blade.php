@extends('layouts.plantilla')

@section('title', 'Registro Ciudadanos')

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
            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                aria-controls="home" aria-selected="false">Registro Ciudadano</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="true">Nuevo Ciudadano</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="categorie-table" class="modal-body table-responsive">

            </div>
        </div>
        <div class="tab-pane fade  show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container p-3">
                <form method="post" action="{{ route('citizens.store') }}" id="miFormulario">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Nombres</p>
                            <input class="form-control" type="text" id="txtId" name="nombres" placeholder="Nombres">
                            @error('nombres')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Apellidos</p>
                            <input class="form-control" type="text" id="txtId" name="apellidos" placeholder="Apellidos">
                            @error('apellidos')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Género</p>
                            <select name="genero" id="sGenero" class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Género --</option>
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                            </select>
                            @error('genero')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Edad</p>
                            <input class="form-control" type="number" id="txtId" name="edad" placeholder="Edad">
                            @error('edad')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Fecha Nacimiento</p>
                            <input class="form-control" type="date" id="txtId" name="fecha_nacimiento">
                            @error('fecha_nacimiento')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Número de Dui</p>
                            <input class="form-control" type="text" id="txtDui" name="dui" placeholder="DUI">
                            @error('dui')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Número de Nit</p>
                            <input class="form-control" type="text" id="txtNit" name="nit" placeholder="NIT">
                            @error('nit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <p class="text-muted text-gray">Posee Inmueble</p>
                            <select name="posee_inmueble" id="sPropietario"
                                class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Propietario Inmueble --</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                            @error('posee_inmueble')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-12 mt-1 text-center card-footer bg-transparent border-primary">
                            <button type="submit" class="btn btn-primary mt-2  btn-md" id="btnGuardar">Agregar</button>
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
                                <input class="form-control" type="text" id="nombres" name="nombres" placeholder="Nombres">
                                <small id="nombresV" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <p class="text-muted text-gray">Apellidos</p>
                                <input class="form-control" type="text" id="apellidos" name="apellidos"
                                    placeholder="Apellidos">
                                <small id="apellidosV" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <p class="text-muted text-gray">Género</p>
                                <select name="genero" id="sGenero"
                                    class="form-control rounded-md shadow-sm mt-1 block w-full">
                                    <option value="" selected>-- Género --</option>
                                    <option value="Hombre">Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                </select>
                                <small id="generoV" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <p class="text-muted text-gray">Edad</p>
                                <input class="form-control" type="number" id="edad" name="edad" placeholder="Edad">
                                <small id="edadV" class="text-danger"></small>

                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <p class="text-muted text-gray">Fecha Nacimiento</p>
                                <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento">
                                <small id="fecha_nacimientoV" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <p class="text-muted text-gray">Número de Dui</p>
                                <input class="form-control" type="text" id="dui" name="dui" placeholder="DUI">
                                <small id="duiV" class="text-danger"></small>

                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <p class="text-muted text-gray">Número de Nit</p>
                                <input class="form-control" type="text" id="nit" name="nit" placeholder="NIT">
                                <small id="nitV" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <p class="text-muted text-gray">Posee Inmueble</p>
                                <select name="posee_inmueble" id="sPropietario"
                                    class="form-control rounded-md shadow-sm mt-1 block w-full">
                                    <option value="" selected>-- Propietario Inmueble --</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                                <small id="posee_inmuebleV" class="text-danger"></small>
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

        $("#btnActualizar").click(function(e) {
            var form = $("#miFormulario2")
            var data = form.serialize()
            $.ajax({
                type: "POST",
                url: "/citizens/update",
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
                error: function(res2) {
                    const errors = res2.responseJSON.errors;
                    (errors.nombres != undefined) ? $("#nombresV").text(`*${errors.nombres}`): $(
                        "#nombresV").hide();
                    (errors.apellidos != undefined) ? $("#apellidosV").text(`*${errors.apellidos}`): $(
                        "#apellidosV").hide();
                    (errors.genero != undefined) ? $("#generoV").text(`*${errors.genero}`): $(
                        "#generoV").hide();
                    (errors.edad != undefined) ? $("#edadV").text(`*${errors.edad}`): $("#edadV")
                        .hide();
                    (errors.fecha_nacimiento != undefined) ? $("#fecha_nacimientoV").text(
                        `*${errors.fecha_nacimiento}`): $("#fecha_nacimientoV").hide();
                    (errors.dui != undefined) ? $("#duiV").text(`*${errors.dui}`): $("#duiV").hide();
                    (errors.nit != undefined) ? $("#nitV").text(`*${errors.nit}`): $("#nitV").hide();
                    (errors.posee_inmueble != undefined) ? $("#posee_inmuebleV").text(
                        `*${errors.posee_inmueble}`): $("#posee_inmuebleV").hide();
                }
            })

        });

        $(document).on("click", "#edit", function(e) {
            let idEditar = $(this).attr("value");
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/citizens/edit/" + idEditar,
                success: function(r) {
                    $("#exampleModal").modal("show"); //abro el modal
                    $("#id").val(r['id']);
                    $("#nombres").val(r['nombres']);
                    $("#apellidos").val(r['apellidos']);
                    $("#edad").val(r['edad']);
                    $("#dui").val(r['dui']);
                    $("#nit").val(r['nit']);
                    $("#fecha_nacimiento").val(r['fecha_nacimiento']);
                    var genero = r['genero'];
                    var posee_inmueble = r['posee_inmueble'];
                    $("#sGenero option[value='" + genero + "']").attr("selected", true);
                    $("#sPropietario option[value='" + posee_inmueble + "']").attr("selected", true);
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
                        url: "/citizens/delete/" + idEliminar,
                        success: function(response) {
                            listado();
                        }
                    });
                    toastr.error("Exito: Registro Eliminado", "Operacion Exitosa");
                }
            })
            e.preventDefault();
        });
        var duiMask = IMask(
            document.getElementById('txtDui'), {
                mask: '00000000-0',
                lazy: true // make placeholder always visible
            }
        );
        var duiMask = IMask(
            document.getElementById('txtNit'), {
                mask: '0000-000000-000-0',
                lazy: true // make placeholder always visible
            }
        );
        var duiMask = IMask(
            document.getElementById('dui'), {
                mask: '00000000-0',
                lazy: true // make placeholder always visible
            }
        );
        var duiMask = IMask(
            document.getElementById('nit'), {
                mask: '0000-000000-000-0',
                lazy: true // make placeholder always visible
            }
        );
    </script>

    @if (auth()->user()->rol == 'Admin' || auth()->user()->rol == 'Jefe')
        <script>
            function listado() {
                $.ajax({
                    type: "GET",
                    url: "/citizens/cargarDatos",
                    dataType: "json",
                    success: function(data) {
                        html = "<table class='table table-striped' id='tablafiltro' width='100%'><thead>";
                        html +=
                            "<tr><th scope='col'>NOMBRES</th><th scope='col'>APELLIDOS</th><th scope='col'>GÉNERO</th>";
                        html += "<th scope='col'>DUI</th><th scope='col'>NIT</th><th scope='col'>NACIMIENTO</th>";
                        html +=
                            "<th scope='col'>EDAD</th><th scope='col'>DUEÑO</th><th scope='col'>ACCIONES</th></tr></thead>";
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
                <a href="/citizens/solvency/${data[key]['id']}" class="btn  btn-primary text-white">
                        <i class="ti-printer mr-1"></i>SOLVENCIA
                    </a>
                </td>`;

                        }
                        html += "</tr></tbody></table>"
                        $("#categorie-table").html(html);
                        //tabla filtro
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
                                    className: 'btn btn-sm btn-success',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fas fa-file-pdf"></i> ',
                                    titleAttr: 'Exportar a PDF',
                                    className: 'btn btn-sm btn-danger',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i> ',
                                    titleAttr: 'Imprimir',
                                    className: 'btn btn-sm btn-info',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                },


                            ],

                            /*End Reportes Data Table*/
                        });
                    }
                });
            }
        </script>
    @else
        <script>
            function listado() {
                $.ajax({
                    type: "GET",
                    url: "/citizens/cargarDatos",
                    dataType: "json",
                    success: function(data) {
                        html = "<table class='table table-striped' id='tablafiltro' width='100%'><thead>";
                        html +=
                            "<tr><th scope='col'>NOMBRES</th><th scope='col'>APELLIDOS</th><th scope='col'>GÉNERO</th>";
                        html += "<th scope='col'>DUI</th><th scope='col'>NIT</th><th scope='col'>NACIMIENTO</th>";
                        html +=
                            "<th scope='col'>EDAD</th><th scope='col'>DUEÑO</th><th scope='col'>ACCIONES</th></tr></thead>";
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
                    <a href="/citizens/solvency/${data[key]['id']}" class="btn  btn-primary text-white">
                        <i class="ti-printer">SOLVENCIA</i>
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
    @endif
@endsection
