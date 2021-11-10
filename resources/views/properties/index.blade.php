@extends('layouts.plantilla')

@section('title', 'Registro Ciudadanos')

@section('content')

    <div id="categorie-table" class="modal-body table-responsive">
        <table class='table table-striped' id='tablafiltro' width='100%'>
            <thead>
                <tr>
                    <th scope='col'>NOMBRES</th>
                    <th scope='col'>APELLIDOS</th>
                    <th scope='col'>GÉNERO</th>
                    <th scope='col'>DUI</th>
                    <th scope='col'>NIT</th>
                    <th scope='col'>NACIMIENTO</th>
                    <th scope='col'>EDAD</th>
                    <th scope='col'>PROPIETARIO</th>
                    <th scope='col'>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <td>{{ $data->nombres }}</td>
                    <td>{{ $data->apellidos }}</td>
                    <td>{{ $data->genero }}</td>
                    <td>{{ $data->dui }}</td>
                    <td>{{ $data->nit }}</td>
                    <td>{{ $data->fecha_nacimiento }}</td>
                    <td>{{ $data->edad }}</td>
                    <td>{{ $data->posee_inmueble }}</td>
                    <td>
                        <a href="/properties/detalles/{{ $data->id }}" id="enviar" class="btn  btn-info text-white">
                            <i class="ti-home"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
        });
    </script>

@endsection
