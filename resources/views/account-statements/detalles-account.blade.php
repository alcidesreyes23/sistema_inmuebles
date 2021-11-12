@extends('layouts.plantilla')

@section('title', 'Estado de cuenta')

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
                }
            });
        })
    </script>
@endsection
