@extends('layouts.plantilla')

@section('title', 'Solvencia municipal')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Solvencia para el ciudadano con ID =
                {{ $id }}</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        @if ($inmuebles != null)
            <h2>{{$estado_ciudadano}}</h2>
        @endif
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="categorie-table" class="modal-body table-responsive">
                <table class='table table-striped table-bordered' id='tablafiltro' width='100%'>
                    <thead>
                        <tr>
                            <th colspan="8" class="text-center bg-dark text-white">DATOS DEL CIUDADANO</th>
                        </tr>
                        <tr>
                            <th scope='col'>NOMBRES</th>
                            <th scope='col'>APELLIDOS</th>
                            <th scope='col'>GÉNERO</th>
                            <th scope='col'>DUI</th>
                            <th scope='col'>NIT</th>
                            <th scope='col'>NACIMIENTO</th>
                            <th scope='col'>EDAD</th>
                            <th scope='col'>DUEÑO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $ciudadano->nombres }} </td>
                            <td>{{ $ciudadano->apellidos }} </td>
                            <td>{{ $ciudadano->genero }} </td>
                            <td>{{ $ciudadano->dui }} </td>
                            <td>{{ $ciudadano->nit }} </td>
                            <td>{{ $ciudadano->fecha_nacimiento }} </td>
                            <td>{{ $ciudadano->edad }} </td>
                            <td>{{ $ciudadano->posee_inmueble }} </td>
                        </tr>
                        @if ($inmuebles != null)
                            <tr>
                                <td colspan="8" class="text-center bg-dark text-white">DATOS DE LOS TRIBUTOS POR INMUEBLES</td>
                            </tr>
                            <tr>
                                <th scope='col'>TRIBUTO</th>
                                <th scope='col'>MESES FACTURADOS</th>
                                <th scope='col'>PAGO FIJO</th>
                                <th scope='col'>MONTO PAGADO</th>
                                <th scope='col'>MONTO ESPERADO</th>
                                <th scope='col'>MONTO DEUDA</th>
                                <th scope='col'>MONTO DEUDA TOTAL</th>
                                <th scope='col'>ESTADO</th>
                            </tr>
                            @foreach ($inmuebles as $item)
                                <tr>
                                    <th colspan="8" class="text-center bg-light">DATOS DEL INMUEBLE ID =
                                        {{ $item->id }}</th>
                                </tr>
                                @foreach ($tributos as $data2)
                                    @if ($item->id == $data2['inmueble_id'])
                                        <tr class="text-center">
                                            <td>{{ $data2['tributo'] }}</td>
                                            <td>{{ $data2['rango'] }}</td>
                                            <td>${{ $data2['pago'] }}</td>
                                            <td>${{ $data2['monto_pagado'] }}</td>
                                            <td>${{ $data2['monto_esperado'] }}</td>
                                            <td>${{ $data2['deuda'] }}</td>
                                            <td>${{ $data2['deuda_total'] }}</td>
                                            @if (strcasecmp($data2['estado'], 'moroso') == 0)
                                                <td class="text-danger">{{ $data2['estado'] }}</td>
                                            @else
                                                <td class="text-success">{{ $data2['estado'] }}</td>
                                            @endif
                                        </tr>
                                    @endif

                                @endforeach
                            @endforeach
                        @endif
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
                }
            });
        })
    </script>
@endsection
