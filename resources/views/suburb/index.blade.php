@extends('layouts.plantilla')

@section('title', 'Colonias')

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
                role="tab" aria-controls="home" aria-selected="true">Lista de colonias</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Nueva colonia</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="table-responsive" id="categorie-table">
                <table class='table table-striped p-3' id='tablafiltro' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>COLONIA</th>
                            <th scope='col'>CANTIDAD INMUEBLES</th>
                            <th scope='col'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->colonia }}</td>
                                <td>{{ $data->cantidad }}</td>
                                <td>
                                    <a href="#" id="edit" value="{{ $data->id }}" class="btn  btn-warning"> <i class="ti-pencil"></i> </a>
                                    <a href="#" id="del" value="{{ $data->id }}" class="btn  btn-danger"> <i class="icon-trash"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container p-5">
                <form method="post" action="{{ route('suburb.store') }}" id="miFormulario">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-6 my-2">
                            <label class="form-label">Ingrese el nombre de la colonia:</label>
                            <input class="form-control" type="text" id="" name="colonia" placeholder="Nombre...">
                            <small id="col" class="text-danger"></small>
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
                        <i class="fa fa-user"></i> Actualizar Información
                    </h5>
                </div>
                <div class="modal-body">
                    <form id="miFormulario2" method="POST">
                        <div class="row">
                            @method('PUT')
                            @csrf
                            <input type="hidden" id="id" name="id">
                            <div class="col-12 col-sm-12 col-md-12 my-2">
                                <label class="form-label">Ingrese el nombre de la colonia:</label>
                                <input class="form-control" type="text" id="colonia" name="colonia"
                                    placeholder="Nombre..." value="{{ old('colonia') }}">
                                <small id="cola" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 my-2">
                                <label class="form-label">Cantidad inmuebles:</label>
                                <input class="form-control" type="number" id="cantidad" name="cantidad"
                                    placeholder="Nombre..." value="{{ old('cantidad') }}">
                                <small id="cant" class="text-danger"></small>
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
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fas fa-file-pdf"></i> ',
                                titleAttr: 'Exportar a PDF',
                                className: 'btn btn-sm btn-danger',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },
                            {
                                extend: 'print',
                                text: '<i class="fa fa-print"></i> ',
                                titleAttr: 'Imprimir',
                                className: 'btn btn-sm btn-info',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            },


                        ],

                        /*End Reportes Data Table*/
            });
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
                    location.reload();
                },
                error: function(res) {
                    const errors = res.responseJSON.errors;
                    (errors.colonia != undefined) ? $("#col").text(`*${errors.colonia}`): $("#col")
                        .hide();
                }
            })
        });

        $("#btnActualizar").click(function(e) {
            var form = $("#miFormulario2")
            var data = form.serialize()
            $.ajax({
                type: "POST",
                url: "/suburb/update",
                dataType: "json",
                data: data,
                success: function(response) {
                    if (response) {
                        toastr.success("Exito: Registro Actualizado", "Operacion Exitosa");
                        $("#exampleModal").modal("hide");
                        $("#miFormulario2")[0].reset();
                        location.reload();
                    }
                },
                error: function(res) {
                    const errors = res.responseJSON.errors;
                    (errors.colonia != undefined) ? $("#cola").text(`*${errors.colonia}`): $("#cola")
                        .hide();
                    (errors.cantidad != undefined) ? $("#cant").text(`*${errors.cantidad}`): $("#cant")
                        .hide();
                    toastr.error("Error: Registro NO Actualizado", "Operacion No Completada");
                }
            })
        });

        $(document).on("click", "#edit", function(e) {
            let idEditar = $(this).attr("value");
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/suburb/edit/" + idEditar,
                success: function(r) {
                    $("#exampleModal").modal("show"); //abro el modal
                    $("#id").val(r['id']);
                    $("#colonia").val(r['colonia']);
                    $("#cantidad").val(r['cantidad']);
                },
            });
            e.preventDefault();
        });

        $(document).on("click", "#del", function(e) {
            let idEliminar = $(this).attr("value");
            Swal.fire({
                title: "¿Desea eliminar la colonia del sistema?",
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
                        url: "/suburb/delete/" + idEliminar,
                        success: function(response) {
                            location.reload();
                        }
                    });
                    toastr.success("Exito: Registro Eliminado", "Operacion Exitosa");
                }
            })
            e.preventDefault();
        });
    </script>

@endsection
