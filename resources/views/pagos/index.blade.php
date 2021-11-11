@extends('layouts.plantilla')

@section('title', 'Registro Ciudadanos')

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
