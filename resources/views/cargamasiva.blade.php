@extends('layouts.app')

@section('title')
    Carga Masiva |
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Carga Masiva</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h4>Subir el Archivo</h4>
                                </div>
                            </div>
                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-10">
                                        <input type="file" name="file" class="form-control" value="">
                                    </div>
                                    <div class="col-md-2 mt-1 d-flex justify-content-end">
                                        <button class="btn btn-success">
                                            <i class="fas fa-file-upload"></i> Carga masiva
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <a href="" class="btn btn-primary d-flex justify-content-center">Descarga el formato</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-primary d-flex justify-content-center">Guía de permisos y conceptos</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="" class="btn btn-primary d-flex justify-content-center">Manual para carga masiva</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


