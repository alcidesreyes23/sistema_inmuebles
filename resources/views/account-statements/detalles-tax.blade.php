@extends('layouts.plantilla')

@section('title', 'Tributos del inmueble')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Lista tributos asignados al inmueble con ID = {{$id}}</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="categorie-table" class="modal-body table-responsive">
                <table class='table table-striped' id='tablafiltro' width='100%'>
                    <thead>
                        <tr>
                            <th scope='col'>TRIBUTO</th>
                            <th scope='col'>MONTO PAGADO</th>
                            <th scope='col'>DEUDA TOTAL</th>
                            <th scope='col'>FECHA DE REGISTRO</th>
                            <th scope='col'>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->tributo }}</td>
                            <td>{{ $data->monto_pagado }}</td>
                            <td>{{ $data->deuda_total }}</td>
                            <td>{{ $data->created_at }}</td>
                            <td>
                                <a href="{{ route('account.detallesaccount', ['id' => $data->id, 'idI' => $id] ) }}" class="btn  btn-warning text-white">
                                    ESTADO DE CUENTA
                                </a>
                            </td>
                        </tr>
                        @endforeach
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
