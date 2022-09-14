@extends('layouts.app')
@section('title')
Nuevo Registro |
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Nuevo Registro</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- TOASTR -->
                        @if(session()->has('error'))
                            {{ session()->get('error') }}
                        @elseif (session()->has('success'))
                            {{ session()->get('success') }}
                        @endif
                        <form action="{{route('store')}}" method="POST">
                            @csrf
                            @foreach ( $resp as $r)
                            <div class="form-row">
                                <div class="col-md-2 mb-6">
                                    <label for="codigo">Código</label>
                                    <input type="text" class="form-control" id="codigo" value="{{ $r['CODIGO'] }}" name="codigo" required readonly>
                                </div>
                                <div class="col-md-2 mb-6" style="display: none;">
                                    <label for="tipo_documento_persona">Tipo Documento</label>
                                    <input type="text" class="form-control" id="tipo_documento_persona" value="{{ $r['DOC_CODIGO'] }}" name="tipo_documento_persona" required readonly>
                                </div>
                                <div class="col-md-2 mb-6">
                                    <label for="documento_persona">Documento</label>
                                    <input type="text" class="form-control" id="documento_persona" value="{{ $r['DOC_IDENTIDAD'] }}" name="documento_persona" required readonly>
                                </div>
                                <div class="col-md-6 mb-6">
                                    <label for="nombres">Nombres y Apellidos</label>
                                    <input type="text" class="form-control" id="nombres" value="{{ $r['NOMBRE_COMPLETO'] }}" name="nombres" required readonly>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="reglaboral">Regimen Laboral</label>
                                    <input type="text" class="form-control" id="reglaboral" value="{{ $r['REGIMEN_LABORAL'] }}" name="reglaboral" required readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="uniorg">Unidad Orgánica</label>
                                    <input type="text" class="form-control" id="uniorg" value="{{ $r['CENTROCOSTO'] }}" name="uniorg" required readonly>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="ingreso">Ingreso Labores</label>
                                    <input type="text" class="form-control" id="ingreso" value="{{ $r['FEC_INGRESO'] }}" name="ingreso" required readonly>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="estado">Estado</label>
                                    <input type="text" class="form-control" id="estado" value="{{ $r['ESTADO'] }}" name="estado" required readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="tpermiso">Tipo de Permiso</label>
                                    <select class="form-control" name="tpermiso" id="tpermiso">
                                        <option selected value="SELECCIONAR">SELECCIONAR</option>
                                        @foreach($permisos as $p)
                                        <option value="{{$p->id}}">{{$p->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="concepto">Concepto</label>
                                    <select class="form-control" id="concepto" name="concepto">
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="fecinicio">Inicio Permiso</label>
                                    <input type="date" class="form-control" name="fecinicio" id="fecinicio" required>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="fecfin">Fin Permiso</label>
                                    <input type="date" class="form-control" name="fecfin" id="fecfin" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="diaspersonal">Días</label>
                                    <input type="text" class="form-control" name="diaspersonal" id="diaspersonal" readonly>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="anioperiodo">Año Periodo</label>
                                    <input type="text" class="form-control" name="anioperiodo" id="anioperiodo" required>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="observaciones">Observaciones</label>
                                    <input type="text" class="form-control" name="observaciones" id="observaciones">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="documento_ref">Documento Sustentario</label>
                                    <input type="text" class="form-control" name="documento_ref" id="documento_ref">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-primary mt-2" type="submit"><i class="fas fa-save"></i> Crear Registro</button>
                                </div>
                            </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $('document').ready(() => {

        //Calculo de días automatico
        var f1,f2,r1,r2,t,tf,resp;
        const anio = 1000*60*60*24;
        $('#tpermiso').focus();

        $('#fecinicio').change(function () {
            f1 = new Date($('#fecinicio').val());
            r1 = f1.getTime();
         });

        $('#fecfin').change(function () {
            f2 = new Date($('#fecfin').val());
            r2 = f2.getTime();
            t = r2-r1;
            tf = Math.floor(t/anio);
            resp = tf+1;
            console.log(resp);
            $('#diaspersonal').val(resp);
        });

        $("#tpermiso").change(function() {
            var tipoconcepto_id = $(this).val();
            if (tipoconcepto_id) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route("conceptos.all") }}',
                    dataType: 'json',
                    success: function(data) {
                        $('#tpermiso').on('click', () => {
                            $("#concepto").empty();
                        })
                        if ($('#tpermiso').val() == 1) {
                            $.each(data, (key, value) => {
                                $("#concepto").append('<option value="' + value[11].id + '">' + value[11].descripcion + '</option>');
                            });
                        } else if ($('#tpermiso').val() == 2) {
                            $.each(data, function(key, value) {
                                for (var i = 0; i < 3; i++) {
                                    $("#concepto").append('<option value="' + value[i].id + '">' + value[i].descripcion + '</option>');
                                }
                            });
                        } else if ($('#tpermiso').val() == 3) {
                            $.each(data, function(key, value) {
                                for (var i = 3; i < 11; i++) {
                                    $("#concepto").append('<option value="' + value[i].id + '">' + value[i].descripcion + '</option>');
                                }
                            });
                        } else if ($('#tpermiso').val() == 4) {
                            $.each(data, (key, value) => {
                                $("#concepto").append('<option value="' + value[12].id + '">' + value[12].descripcion + '</option>');
                            });
                        } else if ($('#tpermiso').val() == 5) {
                            $.each(data, (key, value) => {
                                $("#concepto").append('<option value="' + value[13].id + '">' + value[13].descripcion + '</option>');
                            });
                        }
                    }
                });
            }

            // //Bloquear las fechas anteriores a la actual
            // var fecha = new Date();
            // var anio = fecha.getFullYear();
            // var dia = fecha.getDate();
            // var _mes = fecha.getMonth();//viene con valores de 0 al 11
            // _mes = _mes + 1;//ahora lo tienes de 1 al 12
            // if (_mes < 10)//ahora le agregas un 0 para el formato date
            // { var mes = "0" + _mes;}
            // else
            // { var mes = _mes.toString;}
            // document.getElementById("fecinicio").min = anio+'-'+mes+'-'+dia;
            // document.getElementById("fecfin").min = anio+'-'+mes+'-'+dia;
        });

    });
</script>
@endsection
