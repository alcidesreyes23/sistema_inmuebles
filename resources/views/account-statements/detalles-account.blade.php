@extends('layouts.plantilla')

@section('title', 'Estado de cuenta')

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
                role="tab" aria-controls="home" aria-selected="true">Estado de cuenta sobre el TRIBUTO con ID =
                {{ $id }}</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="categorie-table" class="modal-body table-responsive">
                <table class='table table-striped' id='tablafiltro' width='100%'>
                    <thead>
                        <tr>
                            <th scope='col'>CANTIDAD MESES</th>
                            <th scope='col'>MESES FACTURADOS</th>
                            <th scope='col'>PAGO FIJO</th>
                            <th scope='col'>MONTO PAGADO</th>
                            <th scope='col'>MONTO ESPERADO</th>
                            <th scope='col'>MONTO DEUDA</th>
                            <th scope='col'>MONTO DEUDA TOTAL</th>
                            <th scope='col'>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>{{ $data2['meses'] }}</td>
                            <td>{{ $data2['rango'] }}</td>
                            <td>${{ $data2['pago'] }}</td>
                            <td>${{ $data2['monto_pagado'] }}</td>
                            <td>${{ $data2['monto_esperado'] }}</td>
                            <td>${{ $data2['deuda'] }}</td>
                            <td>${{ $data2['deuda_total'] }}</td>
                            @if (strcasecmp($data2['estado'],'moroso') == 0)
                                <td class="text-danger">{{ $data2['estado'] }}</td>
                            @else
                                <td class="text-success">{{ $data2['estado'] }}</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
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
        })
    </script>
@endsection
