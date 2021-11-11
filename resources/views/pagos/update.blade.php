@extends('layouts.plantilla')

@section('title', 'Registro Ciudadanos')

@section('content')
    @foreach ($data as $data)
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Formulario de cancelacion pago</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container px-3">
                <form method="post" action="{{ route('pagos.update') }}" id="frmPagos">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="monto_old" value="{{$data->monto_pago}}"/>
                    <div class="row">
                        <div class="col-12 col-sm-3 col-md-3 my-2">
                            <p class="text-muted text-gray">ID del inmueble:</p>
                            <input class="form-control" type="text" id="inmueble_id" name="inmueble_id" value="{{ $data->inmueble_id }}">
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 my-2">
                            <p class="text-muted text-gray">ID del pago:</p>
                            <input class="form-control" type="text" id="pago_id" name="pago_id" value="{{ $data->pago_id }}">
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 my-2">
                            <p class="text-muted text-gray">Mes del pago:</p>
                            <input class="form-control" type="text" id="mes" name="mes" value="{{ $data->mes }}">
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 my-2">
                            <p class="text-muted text-gray">Año del pago:</p>
                            <input class="form-control" type="text" id="anio" name="anio" value="{{ $data->anio }}">
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 my-2">
                            <p class="text-muted text-gray">Tributo:</p>
                            <textarea class="form-control" id="tributo" name="tributo" value="">{{ $data->tributo }}</textarea>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 mb-2 mt-5">
                            <div class="d-flex justify-content-between">
                                <h3 class="text-muted text-gray">Datos del pago</h3>
                            </div>
                            <hr />
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Ingrese el monto a pagar:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" id="monto_pago" name="monto_pago">
                            </div>
                            <small id="monto" class="text-danger"></small>
                        </div>
                        <div class="col-12"></div>
                        <div class="col-12 col-sm-3 col-md-3 my-2">
                            <p class="text-muted text-gray">Mora:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" value="{{$data->mora}}" id="mora" name="mora">
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 my-2">
                            <p class="text-muted text-gray">Saldo:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" value="{{$data->saldo}}" id="saldo" name="saldo">
                            </div>
                            <small id="sal" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 my-2">
                            <p class="text-muted text-gray">Total a pagar:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" value="{{$data->total_pagar - $data->monto_pago}}" id="tot" name="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 my-2">
                            <p class="text-muted text-gray">Total de la deuda:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" value="{{$data->total_pagar}}" id="total" name="total_pagar">
                            </div>
                        </div>
                        <div class="col-12 mt-1 text-center card-footer bg-transparent border-primary">
                            <button class="btn btn-primary mt-2  btn-md" id="btnGuardar">Ingresar pago</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let saldo = {{$data->saldo}};
            $("#inmueble_id,#saldo,#mora,#total,#tot,#tributo,#pago_id,#mes,#anio").attr("disabled", true);

            $("#btnGuardar").click(function(e) {
                e.preventDefault()
                $("#pago_id,#saldo").attr("disabled", false);
                var form = $("#frmPagos")
                var method = form.attr('method')
                var action = form.attr('action')
                var data = form.serialize()
                $.ajax({
                    type: method,
                    url: action,
                    dataType: "json",
                    data: data,
                    success: function(response) {
                        var mensaje = (response) ? 'Pago exitoso!.' : 'Error al realizar pago';
                        toastr.success(mensaje, 'Pago', {
                            timeOut: 4000
                        });
                        location.href = '{{ route('pagos.detalle',$data->inmueble_id) }}';
                    },
                    error: function(res) {
                        const errors = res.responseJSON.errors;
                        console.log(errors)
                        (errors.monto_pago != undefined) ? $("#monto").text(`*${errors.monto_pago}`): $("#monto").hide();
                        (errors.saldo != undefined) ? $("#sal").text(`*${errors.saldo}`): $("#sal").hide();
                    }
                })
                $("#inmueble_id,#saldo,#mora,#total,#tot,#tributo,#pago_id,#mes,#anio").attr("disabled", true);
            });

            $('#monto_pago').on('input', function(e) {
                const monto = $(this).val();
                $("#saldo").val((saldo - monto).toFixed(2));
            });
        })
    </script>

@endsection
