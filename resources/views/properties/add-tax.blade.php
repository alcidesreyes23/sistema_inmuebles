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
                role="tab" aria-controls="home" aria-selected="true">Tributos para Inmueble = {{$id}}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Asignar tributo</button>
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
                            <th scope='col'>MONTO FIJO</th>
                            <th scope='col'>MONTO PAGADO</th>
                            <th scope='col'>DEUDA TOTAL</th>
                            <th scope='col'>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->tributo }}</td>
                            <td>${{ $data->monto_fijo }}</td>
                            <td>${{ $data->monto_pagado }}</td>
                            <td>${{ $data->deuda_total }}</td>
                            <td>
                                <a href="#" id="del" value="{{ $data->id }}" class="btn  btn-danger"> 
                                    <i class="ti-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container p-5">
                <form method="POST" action="{{ route('properties.tax') }}" id="miFormulario">
                    @csrf
                    <div class="row">
                        <input class="form-control" type="hidden" id="inmueble_id" name="inmueble_id"
                                value="{{ $id }}">
                            <small id="idi" class="text-danger"></small>
                        <div class="col-12"></div>
                        <div class="col-12 col-sm-5 col-md-5 my-2">
                            <p class="text-muted text-gray">Fecha de registro:</p>
                            <input class="form-control" type="month" id="mes" name="mes">
                            <small id="fec" class="text-danger"></small>
                        </div>
                        <div class="col-12"></div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Tributos:</p>
                            <select name="tributo_id" id="tributo"
                                class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Tributos --</option>
                                @foreach ($taxes as $item)
                                    <option value="{{ $item->id }}">{{ $item->tributo }}</option>
                                @endforeach
                            </select>
                            <small id="idt" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Categoria tributos:</p>
                            <select name="sub_id" id="sub" class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Categoria --</option>
                            </select>
                            <small id="ids" class="text-danger"></small>
                        </div>
                        <div class="col-12 mt-1 text-center card-footer bg-transparent border-primary">
                            <button class="btn btn-primary mt-2  btn-md" id="btnGuardar">Agregar</button>
                        </div>
                    </div>
                </form>
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
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> ',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-sm btn-danger',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> ',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-sm btn-info',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },

                ],

                /*End Reportes Data Table*/
            });

            $("#tributo").on("change", function() {
                const id = $(this).val();
                if (id) {
                    $.ajax({
                        type: "GET",
                        url: "/payment/get-sub/" + id,
                        dataType: "json",
                        success: function(response) {
                            if (response.length > 0) {
                                $("#sub").empty();
                                $("#sub").attr("disabled", false);
                                llenarCombo(response);
                            } else {
                                $("#sub").attr("disabled", true);
                                llenarCombo("");
                            }
                        }
                    })
                }
            });

            const llenarCombo = (data) => {
            $("#sub").append('<option value="" selected>-- Categoria --</option>');
            if (data.length > 0) {
                for (var key in data) {
                    $("#sub").append('<option value=' + data[key]['id'] + '>' + data[key]['nombre_subdivision'] +
                        '</option>');
                }
                }
            }


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
                        var mensaje = (response) ? 'Asignación de tributos correcta!.' : 'Error al realizar asignacion';
                        toastr.success(mensaje, 'Exito', {
                            timeOut: 4000
                        });
                         location.reload();
                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
                
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
                        url: "/properties/delete2/" + idEliminar,
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
