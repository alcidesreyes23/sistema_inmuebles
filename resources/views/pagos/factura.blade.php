@extends('layouts.plantilla')

@section('title', 'Registro Ciudadanos')

@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Formulario de pago</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container px-3">
                <form method="post" action="{{ route('pagos.store') }}" id="frmPagos">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-4 my-2">
                            <p class="text-muted text-gray">ID de inmueble:</p>
                            <input class="form-control" type="text" id="inmueble_id" name="inmueble_id"
                                value="{{ $id }}">
                            <small id="idi" class="text-danger"></small>
                        </div>
                        <div class="col-12"></div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Seleccione la fecha:</p>
                            <input class="form-control" type="month" id="mes" name="mes">
                            <small id="fec" class="text-danger"></small>
                        </div>
                        <div class="col-12"></div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Tributos:</p>
                            <select name="tributo_id" id="tributo"
                                class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Tributos --</option>
                                @foreach ($taxes as $item)
                                    <option value="{{ $item->id }}">{{ $item->tributo }}</option>
                                @endforeach
                            </select>
                            <small id="idt" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 my-2">
                            <p class="text-muted text-gray">Categoria tributos:</p>
                            <select name="sub_id" id="sub" class="form-control rounded-md shadow-sm mt-1 block w-full">
                                <option value="" selected>-- Categoria --</option>
                            </select>
                            <small id="ids" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 mb-2 mt-5">
                            <div class="d-flex justify-content-between">
                                <h3 class="text-muted text-gray">Datos del pago</h3>
                                <button class="btn btn-sm btn-success" id="calcular">Calcular pago</button>
                            </div>
                            <hr />
                        </div>
                        <div class="col-12 col-sm-5 col-md-5 my-2">
                            <p class="text-muted text-gray">Ingrese el monto a pagar:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" id="monto_pago" name="monto_pago">
                            </div>
                            <small id="monto" class="text-danger"></small>
                        </div>
                        <div class="col-12"></div>
                        <div class="col-12 col-sm-4 col-md-4 my-2">
                            <p class="text-muted text-gray">Mora:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" value="0" id="mora" name="mora">
                            </div>
                            <small id="mor" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 my-2">
                            <p class="text-muted text-gray">Saldo:</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" value="0" id="saldo" name="saldo">
                            </div>
                            <small id="sal" class="text-danger"></small>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 my-2">
                            <p class="text-muted text-gray">Total a pagar</p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="text" value="0" id="total" name="total_pagar">
                            </div>
                            <small id="to" class="text-danger"></small>
                        </div>
                        <div class="col-12 mt-1 text-center card-footer bg-transparent border-primary">
                            <button class="btn btn-primary mt-2  btn-md" id="btnGuardar">Ingresar pago</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let saldo = 0;
            $("#inmueble_id,#sub,#saldo,#mora,#total").attr("disabled", true);

            $("#btnGuardar").click(function(e) {
                e.preventDefault()
                $("#inmueble_id,#sub,#saldo,#mora,#total").attr("disabled", false);
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
                        location.reload();
                    },
                    error: function(res) {
                        const errors = res.responseJSON.errors;
                        (errors.tributo_id != undefined) ? $("#idt").text(
                            `*${errors.tributo_id}`): $("#idt").hide();
                        (errors.inmueble_id != undefined) ? $("#idi").text(
                            `*${errors.inmueble_id}`): $("#idi").hide();
                        (errors.sub_id != undefined) ? $("#ids").text(`*${errors.sub_id}`): $(
                            "#ids").hide();
                        (errors.monto_pago != undefined) ? $("#monto").text(
                            `*${errors.monto_pago}`): $("#monto").hide();
                        (errors.saldo != undefined) ? $("#sal").text(`*${errors.saldo}`): $(
                            "#sal").hide();
                        (errors.mora != undefined) ? $("#mor").text(`*${errors.mora}`): $(
                            "#mor").hide();
                        (errors.total_pagar != undefined) ? $("#to").text(
                            `*${errors.total_pagar}`): $("#to").hide();
                        (errors.mes != undefined) ? $("#fec").text(`*${errors.mes}`): $("#fec")
                            .hide();
                    }
                })
                $("#inmueble_id,#sub,#saldo,#mora,#total").attr("disabled", true);
            });

            $("#tributo").on("change", function() {
                const id = $(this).val();
                if (id) {
                    $.ajax({
                        type: "GET",
                        url: "/payment/get-sub/" + id,
                        dataType: "json",
                        success: function(response) {
                            if (response.length > 0) {
                                $("#sub").empty();
                                $("#sub").attr("disabled", false);
                                llenarCombo(response);
                            } else {
                                $("#sub").attr("disabled", true);
                                llenarCombo("");
                            }
                        }
                    })
                }
            });

            $('#monto_pago').on('input', function(e) {
                const monto = $(this).val();
                $("#saldo").val((saldo - monto).toFixed(2));
            });

            $("#calcular").click(function(e) {
                e.preventDefault()
                $("#inmueble_id").attr("disabled", false);
                var form = $("#frmPagos")
                var method = form.attr('method')
                var data = form.serialize()
                console.log(data);
                $.ajax({
                    type: method,
                    url: '/payment/calculate',
                    dataType: "json",
                    data: data,
                    success: function(response) {
                        console.log(response);
                        $("#mora").val(response.mora);
                        $("#saldo").val(response.saldo);
                        $("#total").val(response.pagoT);
                        saldo = response.saldo;
                        $("#idt").hide();
                        $("#idi").hide();
                        $("#ids").hide();
                        $("#fec").hide();
                    },
                    error: function(res) {
                        const errors = res.responseJSON.errors;
                        (errors.tributo_id != undefined) ? $("#idt").text(
                            `*${errors.tributo_id}`): $("#idt").hide();
                        (errors.inmueble_id != undefined) ? $("#idi").text(
                            `*${errors.inmueble_id}`): $("#idi").hide();
                        (errors.sub_id != undefined) ? $("#ids").text(`*${errors.sub_id}`): $(
                            "#ids").hide();
                        (errors.mes != undefined) ? $("#fec").text(`*${errors.mes}`): $("#fec")
                            .hide();
                    }
                })
                $("#inmueble_id").attr("disabled", true);
            });
        })
        const llenarCombo = (data) => {
            $("#sub").append('<option value="" selected>-- Categoria --</option>');
            if (data.length > 0) {
                for (var key in data) {
                    $("#sub").append('<option value=' + data[key]['id'] + '>' + data[key]['nombre_subdivision'] +
                        '</option>');
                }
            }
        }
    </script>

@endsection
