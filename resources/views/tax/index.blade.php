@extends('layouts.plantilla')

@section('title', 'Tributos')

@section('css')
<style>
    /*para alinear los botones y cuadro de busqueda*/
    .btn-group, .btn-group-vertical {
        position: absolute !important;
}
</style>
   

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Lista de tributos</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Nuevo tributo</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="table-responsive" id="categorie-table">
                <table class='table table-striped p-3' id='tablafiltro' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>TRIBUTO</th>
                            <th scope='col'>COSTO</th>
                            <th scope='col'>TIPO TRIBUTO</th>
                            <th scope='col'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->tributo }}</td>
                                <td>${{ number_format($data->costo, 2) }}</td>
                                <td>{{ $data->tipo_tributo }}</td>
                                <td><a href="#" id="edit" value="{{ $data->id }}" class="btn  btn-warning"> Editar </a>
                                    <a href="#" id="del" value="{{ $data->id }}" class="btn  btn-danger"> Eliminar </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container p-5">
                <form method="POST" action="{{ route('tax.store') }}" id="miFormulario">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-8 col-sm-8  mb-2">
                            <label class="form-label">Nombre del tributo:</label>
                            <input class="form-control" type="text" id="" name="tributo" placeholder="Nombre...">
                            <small id="tri" class="text-danger"></small>
                        </div>
                        <div class="col-8 col-sm-8  my-2">
                            <label class="form-label">Costo del tributo:</label>
                            <input class="form-control" type="text" id="" name="costo" placeholder="Costo...">
                            <small id="cos" class="text-danger"></small>
                        </div>
                        <div class="col-8 col-sm-8  my-2">
                            <label class="form-label">Categoria de tributo:</label>
                            <select name="taxtype_id" id="taxtype"
                                class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Categoria --</option>
                            </select>
                            <small id="cat" class="text-danger"></small>
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
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <label class="form-label">Nombre del tributo:</label>
                                <input class="form-control" type="text" id="tributo" name="tributo"
                                    placeholder="Nombre...">
                                <small id="tria" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <label class="form-label">Costo del tributo:</label>
                                <input class="form-control" type="text" id="costo" name="costo" placeholder="Costo...">
                                <small id="cosa" class="text-danger"></small>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 my-2">
                                <label class="form-label">Categoria de tributo:</label>
                                <select name="taxtype_id" id="taxtype2"
                                    class="form-control rounded-md shadow-sm mt-1 block w-full">
                                </select>
                                <small id="cata" class="text-danger"></small>
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


            llenarCombo();
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
                    console.log(response)
                    var mensaje = (response) ? 'Registo guardado correctamente.' :
                        'Error al insertar registro';
                    toastr.success(mensaje, 'Nuevo Registro', {
                        timeOut: 4000
                    });
                    location.reload();
                },
                error: function(res) {
                    const errors = res.responseJSON.errors;
                    (errors.tributo != undefined) ? $("#tri").text(`*${errors.tributo}`): $("#tri")
                        .hide();
                    (errors.costo != undefined) ? $("#cos").text(`*${errors.costo}`): $("#cos").hide();
                    (errors.taxtype_id != undefined) ? $("#cat").text(`*${errors.taxtype_id}`): $(
                        "#cat").hide();
                }
            })
        });

        $("#btnActualizar").click(function(e) {
            var form = $("#miFormulario2")
            var data = form.serialize()
            $.ajax({
                type: "POST",
                url: "/tax/update",
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
                    (errors.tributo != undefined) ? $("#tria").text(`*${errors.tributo}`): $("#tria")
                        .hide();
                    (errors.costo != undefined) ? $("#cosa").text(`*${errors.costo}`): $("#cosa")
                        .hide();
                    (errors.taxtype_id != undefined) ? $("#cata").text(`*${errors.taxtype_id}`): $(
                        "#cata").hide();
                    toastr.error("Error: Registro NO Actualizado", "Operacion No Completada");
                }
            })
        });

        $(document).on("click", "#edit", function(e) {
            $("#taxtype2").empty();
            llenarComboE();
            let idEditar = $(this).attr("value");
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/tax/edit/" + idEditar,
                success: function(r) {
                    $("#exampleModal").modal("show"); //abro el modal
                    $("#id").val(r['id']);
                    $("#tributo").val(r['tributo']);
                    $("#costo").val(r['costo']);
                    $("#taxtype2").val(r['taxtype_id']);
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
                        url: "/tax/delete/" + idEliminar,
                        success: function(response) {
                            location.reload();
                        }
                    });
                    toastr.success("Exito: Registro Eliminado", "Operacion Exitosa");
                }
            })
            e.preventDefault();
        });

        const llenarCombo = () => {
            $.ajax({
                type: "GET",
                url: "/tax-types/show",
                dataType: "json",
                success: function(data) {
                    for (var key in data) {
                        $("#taxtype").append('<option value=' + data[key]['id'] + '>' + data[key][
                            'tipo_tributo'
                        ] + '</option>');
                    }
                }
            });
        }

        const llenarComboE = () => {
            $.ajax({
                type: "GET",
                url: "/tax-types/show",
                dataType: "json",
                success: function(data) {
                    for (var key in data) {
                        $("#taxtype2").append('<option value=' + data[key]['id'] + '>' + data[key][
                            'tipo_tributo'
                        ] + '</option>');
                    }
                }
            });
        }

        
    </script>

@endsection
