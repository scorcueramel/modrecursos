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
                            <form action="{{ route('store') }}" method="POST" class="needs-validation my-4" novalidate>
                                @foreach ($resp as $r)
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <label for="codigo">Código</label>
                                            <input type="text" class="form-control" id="codigo"
                                                value="{{ $r['CODIGO'] }}" required readonly>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="docident">Documento de Identidad</label>
                                            <input type="text" class="form-control" id="docident"
                                                value="{{ $r['DOC_IDENTIDAD'] }}" required readonly>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="nombres">Nombres y Apellidos</label>
                                            <input type="text" class="form-control" id="nombres"
                                                value="{{ $r['NOMBRE_COMPLETO'] }}" required readonly>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="reglab">Regimen Laboral</label>
                                            <input type="text" class="form-control" id="reglab"
                                                value="{{ $r['REGIMEN_LABORAL'] }}" required readonly>
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
                                            <input type="text" class="form-control" id="uniorg"
                                                value="{{ $r['CENTROCOSTO'] }}" required readonly>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="ingreso">Ingreso Labores</label>
                                            <input type="text" class="form-control" id="ingreso"
                                                value="{{ $r['FEC_INGRESO'] }}" required readonly>
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
                                                <input type="text" class="form-control" id="cese" value="Laborando"
                                                    required readonly>
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
                                                <input type="text" class="form-control" id="cese"
                                                    value="{{ $r['FEC_CESE'] }}" required readonly>
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
                                            <label for="cese">Estado</label>
                                            <input type="text" class="form-control" id="cese"
                                                value="{{ $r['ESTADO'] }}" required readonly>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tpermiso">Tipo de Permiso</label>
                                            <select class="form-control" id="tpermiso">
                                                <option selected value="SELECCIONAR">SELECCIONAR</option>
                                                @foreach ($tipopermiso as $tp)
                                                    <option value="{{ $tp->id }}">{{ $tp->descripcion }}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="concepto">Tipo de Permiso</label>
                                            <select class="form-control" id="concepto">
                                                <option selected value="SELECCIONAR">SELECCIONAR</option>
                                                @foreach ($concepto as $c)
                                                    <option value="{{ $c->id }}">{{ $c->descripcion }}</option>
                                                @endforeach
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
                                            <input type="date" class="form-control" id="fecinicio" required>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="fecfin">Fin Permiso</label>
                                            <input type="date" class="form-control" id="fecfin" required>
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
                                            <input type="text" class="form-control" id="documento" required>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="comentario">Comentario</label>
                                            <input type="text" class="form-control" id="comentario" required>
                                            <div class="valid-feedback">
                                                Correcto!
                                            </div>
                                            <div class="invalid-feedback">
                                                Porfavor Valide este campo!
                                            </div>
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
        $('document').ready(()=>{
            $('#tpermiso').focus();
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
