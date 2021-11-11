@extends('layouts.plantilla')

@section('title', 'Registro de Propiedades')

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

    <div id="categorie-table p-5" class="modal-body table-responsive">
        <table class='table table-striped' id='tablafiltro' width='100%'>
            <thead>
                <tr>
                    <th scope='col'>ID INMUEBLE</th>
                    <th scope='col'># PROPIEDAD</th>
                    <th scope='col'>CALLE</th>
                    <th scope='col'>NOMBRES</th>
                    <th scope='col'>APELLIDOS</th>
                    <th scope='col'>DUI</th>
                    <th scope='col'>NIT</th>
                    <th scope='col'>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->num }}</td>
                    <td>{{ $data->calle }}</td>
                    <td>{{ $data->nombres }}</td>
                    <td>{{ $data->apellidos }}</td>
                    <td>{{ $data->dui }}</td>
                    <td>{{ $data->nit }}</td>
                    <td>
                        <a href="{{route('pagos.factura',$data->id)}}" id="enviar" class="btn  btn-success text-white">
                            <i class="ti-money"></i>
                        </a>
                        <a href="{{route('pagos.detalle',$data->id)}}" id="enviar" class="btn  btn-success text-white">
                            <i class="ti-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js')
@if (auth()->user()->rol == 'Admin' || auth()->user()->rol == 'Jefe')
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
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fas fa-file-pdf"></i> ',
                                    titleAttr: 'Exportar a PDF',
                                    className: 'btn btn-sm btn-danger',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    }
                                },
                                {
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i> ',
                                    titleAttr: 'Imprimir',
                                    className: 'btn btn-sm btn-info',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
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
