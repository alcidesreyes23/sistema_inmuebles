@extends('layouts.plantilla')

@section('title', 'Lista Inmuebles')

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

    <div id="categorie-table" class="modal-body table-responsive">
        <table class='table table-striped' id='tablafiltro' width='100%'>
            <thead>
                <tr>
                    <th scope='col'>ID PROPIEDAD</th>
                    <th scope='col'>COLONIA</th>
                    <th scope='col'>TIPO INMUEBLE</th>
                    <th scope='col'>CALE</th>
                    <th scope='col'>AREA CUADRADA</th>
                    <th scope='col'># INMUEBLE</th>
                    <th scope='col'>ACCION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->colonia }}</td>
                    <td>{{ $data->tipo_inmueble}}</td>
                    <td>{{ $data->calle }}</td>
                    <td>{{ $data->total }}</td>
                    <td>{{ $data->numero_inmueble }}</td>
                    <td>
                        <a href="#" id="enviar" class="btn  btn-info text-white">
                            <i class="ti-server"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js')
@if(auth()->user()->rol == 'Admin' || auth()->user()->rol == 'Jefe')
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
        });
    </script>
@else
<script>
    $(document).ready(function() {
        $('#tablafiltro').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });
    });
</script>
@endif
@endsection
