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
                            <div class="row">
                                {!! Form::open(['route' => 'store', 'method' => 'POST']) !!}
                                <div class="col">
                                    @foreach ($resp as $r)
                                        <label for="codigo">Código Trabajador</label>
                                        <input type="text" class="form-control" name="codigo" id="codigo" value="{{$r['CODIGO']}}" readonly>

                                        <label for="numdoc">Documento Identidad</label>
                                        <input type="text" class="form-control" name="numdoc" id="numdoc" value="{{$r['DOC_IDENTIDAD']}}" readonly>

                                        <label for="nombre">Nombres y Apellidos</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{$r['NOMBRE_COMPLETO']}}" readonly>

                                        <label for="estado_persona">Estado</label>
                                        <input type="text" class="form-control" name="estado_persona" id="estado_persona" value="{{$r['ESTADO']}}" readonly>

                                        <label for="reglab">Rég. Laboral</label>
                                        <input type="text" class="form-control" name="reglab" id="reglab" value="{{$r['REGIMEN_LABORAL']}}" readonly>

                                        <label for="uniorg">Unidad Orgánica</label>
                                        <input type="text" class="form-control" name="uniorg" id="uniorg" value="{{$r['CENTROCOSTO']}}" readonly>

                                        <label for="fechingreso">Fecha inicio</label>
                                        <input type="text" class="form-control" name="fechingreso" id="fechingreso" value="{{$r['FEC_INGRESO']}}" readonly>

                                        <label for="tipopermiso">Tipo Permiso</label>
                                        <select name="tipopermiso" class="form-control custom-select">
                                            <option value="">Elegir Tipo Permiso</option>
                                            @foreach($tipo_permiso as $tp)
                                              <option value="{{ $tp->id }}"{{ $tp->descripcion }}</option>
                                            @endforeach
                                        </select>
{{--  
                                        <label for="fechainicio">Fecha inicio</label>
                                        <input type="text" class="form-control" name="fechainicio" id="fechainicio" value="{{$r['REGIMEN_LABORAL']}}" readonly>

                                        <label for="fechafin">Fecha cese</label>
                                        <input type="text" class="form-control" name="fechafin" id="fechafin" value="{{$r['REGIMEN_LABORAL']}}" readonly>  --}}
                                    @endforeach
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
