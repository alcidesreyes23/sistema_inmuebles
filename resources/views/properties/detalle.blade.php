@extends('layouts.plantilla')

@section('title', 'Registro Inmuebles')

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
                role="tab" aria-controls="home" aria-selected="true">Lista Inmuebles</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Nuevo Inmueble</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="categorie-table" class="modal-body table-responsive">

            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container p-3">
                <form method="post" action="{{ route('properties.store') }}" id="miFormulario">
                    @csrf
                    <input type="hidden" id="idCiudadano" name="idCiudadano" value="{{ $id }}">
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Ancho</p>
                            <input class="form-control" type="text" id="ancho" name="ancho" placeholder="Ancho en Metros">
                            <small id="anchoV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Largo</p>
                            <input class="form-control" type="text" id="largo" name="largo" placeholder="Largo en Metros">
                            <small id="largoV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Colonia</p>
                            <select name="colonia" id="colonia" class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Colonias --</option>
                                @foreach ($colonias as $item)
                                    <option value="{{ $item->id }}">{{ $item->colonia }}</option>
                                @endforeach
                            </select>
                            <small id="coloniaV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Tipo Inmueble</p>
                            <select name="tipo" id="tipo" class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Tipo --</option>
                                @foreach ($tipos as $item)
                                    <option value="{{ $item->id }}">{{ $item->tipo_inmueble }}</option>
                                @endforeach
                            </select>
                            <small id="tipoV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Calle</p>
                            <input class="form-control" type="text" id="calle" name="calle" placeholder="Calle">
                            <small id="calleV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Pasaje</p>
                            <input class="form-control" type="text" id="pasaje" name="pasaje" placeholder="Pasaje">
                            <small id="pasajeV" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray"># Propiedad</p>
                            <input class="form-control" type="text" id="numPro" name="numero_inmueble"
                                placeholder="Número de Propiedad">
                            <small id="numV" class="text-danger"></small>
                        </div>
                        <div class="col-12 mt-1 text-center card-footer bg-transparent border-primary">
                            <button class="btn btn-primary mt-2  btn-md" id="btnGuardar">Agregar</button>
                        </div>
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
                            <input type="hidden" id="idPro" name="idPro">
                            <input type="hidden" id="idCiudadano" name="idCiudadano" value="{{ $id }}">
                            <div class="col-12 col-sm-6 col-md-6 my-2">
                                <p class="text-muted text-gray">Ancho</p>
                                <input class="form-control" type="text" id="txtAncho" name="ancho"
                                    placeholder="Ancho en Metros">
                                    <small id="anchoV2" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 my-2">
                                <p class="text-muted text-gray">Largo</p>
                                <input class="form-control" type="text" id="txtLargo" name="largo"
                                    placeholder="Largo en Metros">
                                <small id="largoV2" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 my-2">
                                <p class="text-muted text-gray">Calle</p>
                                <input class="form-control" type="text" id="txtCalle" name="calle" placeholder="Calle">
                                <small id="calleV2" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 my-2">
                                <p class="text-muted text-gray">Pasaje</p>
                                <input class="form-control" type="text" id="txtPasaje" name="pasaje" placeholder="Pasaje">
                                <small id="pasajeV2" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 my-2">
                                <p class="text-muted text-gray"># Propiedad</p>
                                <input class="form-control" type="text" id="txtNum" name="numero_inmueble"
                                    placeholder="Número de Propiedad">
                                <small id="numV2" class="text-danger"></small>
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
                    limpiar();

                    // Actualizamos los datos de la DataTable sin Inicializar
                    listado();
                },
                error: function(res2) {
                    const errors = res2.responseJSON.errors;
                    (errors.colonia != undefined) ? $("#coloniaV").text(`*${errors.colonia}`): $(
                        "#coloniaV").hide();
                    (errors.tipo != undefined) ? $("#tipoV").text(`*${errors.tipo}`): $("#tipoV")
                .hide();
                    (errors.numero_inmueble != undefined) ? $("#numV").text(
                        `*${errors.numero_inmueble}`): $("#numV").hide();
                    (errors.ancho != undefined) ? $("#anchoV").text(`*${errors.ancho}`): $("#anchoV")
                        .hide();
                    (errors.largo != undefined) ? $("#largoV").text(`*${errors.largo}`): $("#largoV")
                        .hide();
                    (errors.pasaje != undefined) ? $("#pasajeV").text(`*${errors.pasaje}`): $(
                        "#pasajeV").hide();
                    (errors.calle != undefined) ? $("#calleV").text(`*${errors.calle}`): $("#calleV")
                        .hide();

                }
            })
        });

        $("#btnActualizar").click(function(e) {
            var form = $("#miFormulario2")
            var data = form.serialize()
            $.ajax({
                type: "POST",
                url: "/properties/update",
                dataType: "json",
                data: data,
                success: function(response) {
                    if (response) {
                        toastr.success("Exito: Registro Actualizado", "Operacion Exitosa");
                        $("#exampleModal").modal("hide");
                        $("#miFormulario2")[0].reset();
                        listado();
                        limpiar2();
                    }

                },
                error: function(res2) {
                    const errors = res2.responseJSON.errors;
                    (errors.numero_inmueble != undefined) ? $("#numV2").text(
                        `*${errors.numero_inmueble}`): $("#numV2").hide();
                    (errors.ancho != undefined) ? $("#anchoV2").text(`*${errors.ancho}`): $("#anchoV2")
                        .hide();
                    (errors.largo != undefined) ? $("#largoV2").text(`*${errors.largo}`): $("#largoV2")
                        .hide();
                    (errors.pasaje != undefined) ? $("#pasajeV2").text(`*${errors.pasaje}`): $(
                        "#pasajeV2").hide();
                    (errors.calle != undefined) ? $("#calleV2").text(`*${errors.calle}`): $("#calleV2")
                        .hide();
                }
            })

        });

        $(document).on("click", "#edit", function(e) {
            let idEditar = $(this).attr("value");
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/properties/edit/" + idEditar,
                success: function(r) {
                    console.log(r);
                    $("#exampleModal").modal("show"); //abro el modal
                    $("#idPro").val(r['id']);
                    $("#txtAncho").val(r['ancho']);
                    $("#txtLargo").val(r['largo']);
                    $("#txtPasaje").val(r['pasaje']);
                    $("#txtCalle").val(r['calle']);
                    $("#txtNum").val(r['numero_inmueble']);
                    var idColonia = r['colonia_id'];
                    var idTipo = r['tipo_inmueble_id'];

                    //var fecha = r['fecha_nacimiento'];
                    $("#sColonia option[value='" + idColonia + "']").attr("selected", true);
                    $("#sTipo option[value='" + idTipo + "']").attr("selected", true);
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
                        url: "/properties/delete/" + idEliminar,
                        success: function(response) {
                            listado();
                        }
                    });
                    toastr.error("Exito: Registro Eliminado", "Operacion Exitosa");
                }
            })
            e.preventDefault();
        });

        function limpiar() {
            $("#ancho").val('');
            $("#largo").val('');
            $("#colonia").val('');
            $("#tipo").val('');
            $("#calle").val('');
            $("#pasaje").val('');
            $("#numPro").val('');
            $("#coloniaV").hide();
            $("#tipoV").hide();
            $("#numV").hide();
            $("#anchoV").hide();
            $("#largoV").hide();
            $("#pasajeV").hide();
            $("#calleV").hide();

        }

        function limpiar2() {

            $("#numV2").hide();
            $("#anchoV2").hide();
            $("#largoV2").hide();
            $("#pasajeV2").hide();
            $("#calleV2").hide();

        }
    </script>

    @if (auth()->user()->rol == 'Admin' || auth()->user()->rol == 'Jefe')
        <script>
            function listado() {
                idCiudadano = $("#idCiudadano").attr("value");
                $.ajax({
                    type: "GET",
                    url: "/properties/cargarDetalle/" + idCiudadano,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        html = "<table class='table table-striped' id='tablafiltro' width='100%'><thead>";
                        html +=
                            "<tr><th scope='col'>ID</th><th scope='col'>COLONIA</th><th scope='col'>TIPO INMUEBLE</th>";
                        html +=
                            "<th scope='col'>CALLE</th><th scope='col'>PASAJE</th><th scope='col'>ANCHO</th><th scope='col'>LARGO</th><th scope='col'>AREA CUADRADA</th><th scope='col'># PROPIEDAD</th><th scope='col'>ACCIONES</th></tr></thead>";
                        html += "<tbody>";
                        //var tbody = "<tbody>";
                        for (var key in data) {
                            html += "<tr>";
                            html += "<td>" + data[key]['id'] + "</td>";
                            html += "<td>" + data[key]['colonia'] + "</td>";
                            html += "<td>" + data[key]['tipo_inmueble'] + "</td>";
                            html += "<td>" + data[key]['calle'] + "</td>";
                            html += "<td>" + data[key]['pasaje'] + "</td>";
                            html += "<td>" + data[key]['ancho'] + "</td>";
                            html += "<td>" + data[key]['largo'] + "</td>";
                            html += "<td>" + data[key]['total'] + "</td>";
                            html += "<td>" + data[key]['numero_inmueble'] + "</td>";
                            html += `<td>
                <a href="#" id="edit" value="${data[key]['id']}" class="btn  btn-warning text-white">
                    <i class="ti-pencil"></i>
                </a>
                <a href="#" id="del" value="${data[key]['id']}" class="btn  btn-danger text-white">
                  <i class="icon-trash"></i>
                </a>
                <a href="../../properties/addTax/${data[key]['id']}" class="btn  btn-info text-white">
                  <i class="ti-server"></i>
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
                idCiudadano = $("#idCiudadano").attr("value");
                $.ajax({
                    type: "GET",
                    url: "/properties/cargarDetalle/" + idCiudadano,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        html = "<table class='table table-striped' id='tablafiltro' width='100%'><thead>";
                        html +=
                            "<tr><th scope='col'>ID</th><th scope='col'>COLONIA</th><th scope='col'>TIPO INMUEBLE</th>";
                        html +=
                            "<th scope='col'>CALLE</th><th scope='col'>PASAJE</th><th scope='col'>ANCHO</th><th scope='col'>LARGO</th><th scope='col'>AREA CUADRADA</th><th scope='col'># PROPIEDAD</th><th scope='col'>ACCIONES</th></tr></thead>";
                        html += "<tbody>";
                        //var tbody = "<tbody>";
                        for (var key in data) {
                            html += "<tr>";
                            html += "<td>" + data[key]['id'] + "</td>";
                            html += "<td>" + data[key]['colonia'] + "</td>";
                            html += "<td>" + data[key]['tipo_inmueble'] + "</td>";
                            html += "<td>" + data[key]['calle'] + "</td>";
                            html += "<td>" + data[key]['pasaje'] + "</td>";
                            html += "<td>" + data[key]['ancho'] + "</td>";
                            html += "<td>" + data[key]['largo'] + "</td>";
                            html += "<td>" + data[key]['total'] + "</td>";
                            html += "<td>" + data[key]['numero_inmueble'] + "</td>";
                            html += `<td>
            <a href="#" id="edit" value="${data[key]['id']}" class="btn  btn-warning text-white">
                <i class="ti-pencil"></i>
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
