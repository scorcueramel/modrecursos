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
                                    @foreach ($resp as $r)
                                        <label for="nombre">Nombres y Apellidos</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{$r['NOMBRE_COMPLETO']}}" readonly>
                                        
                                        <label for="nombre">Rég. Laboral</label>
                                        <input type="text" class="form-control" name="reglab" id="reglab" value="{{$r['REGIMEN_LABORAL']}}" readonly> 
                                        
                                        
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
