@extends('layouts.plantilla')

@section('title', 'Detalles de pagos')

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
                role="tab" aria-controls="home" aria-selected="true">Pagos hechos para el inmueble con ID =
                {{ $id }} </button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="categorie-table" class="modal-body table-responsive">
                <table class='table table-striped p-3' id='tablafiltro' width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th scope='col'>TRIBUTO</th>
                            <th scope='col'>MES</th>
                            <th scope='col'>AÑO</th>
                            <th scope='col'>FECHA</th>
                            <th scope='col'>MONTO</th>
                            <th scope='col'>MORA</th>
                            <th scope='col'>SALDO</th>
                            <th scope='col'>TOTAL</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->tributo }}</td>
                                <td>{{ $data->mes }}</td>
                                <td>{{ $data->anio }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>${{ number_format($data->monto_pago, 2) }}</td>
                                <td>${{ number_format($data->mora, 2) }}</td>
                                <td>${{ number_format($data->saldo, 2) }}</td>
                                <td>${{ number_format($data->total_pagar, 2) }}</td>
                                @if ($data->saldo > 0)
                                    <td>
                                        <a href="{{ route('pagos.edit', $data->pago_id) }}" class="btn  btn-warning">
                                            <i class="ti-money mr-2"></i>PAGAR
                                        </a>
                                    </td>
                                @else
                                    <td class="text-danger">PAGADO</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
