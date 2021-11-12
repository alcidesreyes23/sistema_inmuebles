@extends('layouts.plantilla')

@section('title', 'Estado de cuenta')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Estado de cuenta sobre el TRIBUTO con ID = {{$id}}</button>
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
