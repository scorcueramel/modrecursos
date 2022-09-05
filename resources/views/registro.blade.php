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
                                <div class="col">
                                    <label for="nombre">Nombres y Apellidos</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{$resp['NOMBRE_COMPLETO']}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
