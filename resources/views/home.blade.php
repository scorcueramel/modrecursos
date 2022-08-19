@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Vista General</h3>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-4 mb-4">Prueba de conceptos</h4>
                            <div class="form-row">
                                <div class="form-group col-md">
                                <label for="inputGroupSelect01">Conceptos Descansos Medicos</label>
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option selected>SELECCIONAR</option>
                                    @foreach ($conceptosDM as $dm)
                                    <option value="{{$dm->id}}">{{$dm->Tipo_Concepto}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md">
                                <label for="inputGroupSelect02">Conceptos Licencias</label>
                                <select class="custom-select" id="inputGroupSelect02">
                                    <option selected>SELECCIONAR</option>
                                    @foreach ($conceptosLIC as $lc)
                                    <option value="{{$lc->id}}">{{$lc->Tipo_Concepto}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
