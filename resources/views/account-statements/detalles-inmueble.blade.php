@extends('layouts.plantilla')

@section('title', 'Inmuebles del ciudadano')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Lista Inmuebles del ciudadano con ID = {{$id}}</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div id="categorie-table" class="modal-body table-responsive">
                <table class='table table-striped' id='tablafiltro' width='100%'>
                    <thead>
                        <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>COLONIA</th>
                            <th scope='col'>TIPO INMUEBLE</th>
                            <th scope='col'>CALLE</th>
                            <th scope='col'>PASAJE</th>
                            <th scope='col'>ANCHO</th>
                            <th scope='col'>LARGO</th>
                            <th scope='col'>AREA CUADRADA</th>
                            <th scope='col'># PROPIEDAD</th>
                            <th scope='col'>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->colonia }}</td>
                            <td>{{ $data->tipo_inmueble }}</td>
                            <td>{{ $data->calle }}</td>
                            <td>{{ $data->pasaje }}</td>
                            <td>{{ $data->ancho }}</td>
                            <td>{{ $data->largo }}</td>
                            <td>{{ $data->total }}</td>
                            <td>{{ $data->numero_inmueble }}</td>
                            <td>
                                <a href="{{ route('account.detallestax', $data->id) }}" id="edit"
                                    class="btn  btn-warning text-white">
                                    <i class="ti-money"> Tributos </i>
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
