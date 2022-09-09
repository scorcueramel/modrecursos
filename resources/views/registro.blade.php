@extends('layouts.app')
@section('title')
Nuevo Registro |
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registrar Nuevo</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('store')}}" method="POST">
                            @csrf
                            @foreach ( $resp as $r)
                            <div class="form-row">
                                <div class="col-md-2 mb-6">
                                    <label for="codigo">Cdigo</label>
                                    <input type="text" class="form-control" id="codigo" value="{{ $r['CODIGO'] }}" name="codigo" required readonly>
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
                                <div class="col-md-4 mb-3">
                                    <label for="tpermiso">Tipo de Permiso</label>
                                    <select class="form-control" name="tpermiso" id="tpermiso">
                                        <option selected value="SELECCIONAR">SELECCIONAR</option>
                                        @foreach($permisos as $p)
                                        <option value="{{$p->id}}">{{$p->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="concepto">Concepto</label>
                                    <select class="form-control" id="concepto" name="concepto">
                                    </select>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="fecinicio">Inicio Permiso</label>
                                    <input type="text" class="form-control" name="fecinicio" id="fecinicio" min="2022-09-01" max="2030-12-31" required>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="fecfin">Fin Permiso</label>
                                    <input type="text" class="form-control" name="fecfin" id="fecfin" min="2022-09-01" max="2030-12-31" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="documento_ref">Documento Respaldo</label>
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
        $('#tpermiso').focus();

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
        });

        // $(function() {
        //     $("#fecinicio").datepicker();
        // });
        $(function() {
            var date = new Date();
            date.setDate(date.getDate());
            $('#fecinicio').datepicker({
                startDate: date,
                format: 'dd-mm-yyyy'
            });
            $('#fecfin').datepicker({
                startDate: date,
                format: 'dd-mm-yyyy'
            });
            $('#fecinicio').datepicker("setDate", new Date());
            $('#fecfin').datepicker("setDate", new Date());
        });
    });
</script>
@endsection
