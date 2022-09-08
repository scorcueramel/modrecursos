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
                            <form action="{{route('store')}}" method="POST" class="needs-validation" novalidate>   
                            @foreach ( $resp as $r) 
                            <div class="form-row">                                                   
                                <div class="col-md-3 mb-3">
                                    <label for="docident">Documento de Identidad</label>
                                    <input type="text" class="form-control" id="docident" value="{{ $r['DOC_IDENTIDAD'] }}" name="docident" required readonly>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="nombres">Nombres y Apellidos</label>
                                    <input type="text" class="form-control" id="nombres" value="{{ $r['NOMBRE_COMPLETO'] }}" name="nombres" required readonly>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="reglab">Regimen Laboral</label>
                                    <input type="text" class="form-control" id="reglab" value="{{ $r['REGIMEN_LABORAL'] }}" name="reglab" required readonly>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-6">
                                    <label for="uniorg">Unidad Orgánica</label>
                                    <input type="text" class="form-control" id="uniorg" value="{{ $r['CENTROCOSTO'] }}" name="uniorg" required readonly>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="ingreso">Ingreso Labores</label>
                                    <input type="text" class="form-control" id="ingreso" value="{{ $r['FEC_INGRESO'] }}" name="ingreso" required readonly>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                @if ($r['FEC_CESE'] == '')
                                <div class="col-md-3 mb-3">
                                    <label for="cese">Fecha Cese</label>
                                    <input type="text" class="form-control" name="cese" id="cese" value="Laborando" required readonly>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                @else
                                <div class="col-md-3 mb-3">
                                    <label for="cese">Fecha Cese</label>
                                    <input type="text" class="form-control" id="cese" value="{{ $r['FEC_CESE'] }}" name="cese" required readonly>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label for="estado">Estado</label>
                                    <input type="text" class="form-control" id="estado" value="{{ $r['ESTADO'] }}" name="estado" required readonly>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="tpermiso">Tipo de Permiso</label>
                                    <select class="form-control" name="tpermiso" id="tpermiso">
                                        <option selected value="SELECCIONAR">SELECCIONAR</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="concepto">Concepto</label>
                                    <select class="form-control" id="concepto" name="concepto">
                                        <option selected value="SELECCIONAR">SELECCIONAR</option>
                                    </select>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="fecinicio">Inicio Permiso</label>
                                    <input type="date" class="form-control" name="fecinicio" id="fecinicio" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="fecfin">Fin Permiso</label>
                                    <input type="date" class="form-control" name="fecfin" id="fecfin" required>
                                    <div class="valid-feedback">
                                        Correcto!
                                    </div>
                                    <div class="invalid-feedback">
                                        Porfavor Valide este campo!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="documento">Documento</label>
                                    <input type="text" class="form-control" name="documento" id="documento">
                                </div>
                                <div class="col-md-6 mt-4">
                                    <button class="btn btn-primary mt-2" type="submit"><i class="fas fa-save"></i> Crear
                                        Registro</button>
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
        $.ajax({
            type: 'GET',
            url: "{{route('tipopermisos.all')}}",
            dataType: 'json',
            success: function(tper) {
                var select = $('#tpermiso').add('');
                $.each(tper, function(key, val) {
                    select += "<option value='"+val.id+"'>" + val.descripcion + "</option>"
                    $("#tpermiso").append(select);
                    console.log(tper)
                });
            },
            error: function() {
                console.log(tper);
            }
        });

        $.ajax({
            type: 'GET',
            url: "{{route('conceptos.all')}}",
            dataType: 'json',
            success: function(tcon) {
                console.log(tcon);
            },
            error: function() {
                let err = "Error desconocido, comuniquese con el administrador";
                console.log(err);
            }
        });
    });


    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection