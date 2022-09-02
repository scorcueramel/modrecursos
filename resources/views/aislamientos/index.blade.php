@extends('layouts.app')
@section('title')
    Aislamientos |
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Personal Con Aislaminetos Registrados</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-hover mt-2" id="aislamientos">
                                <thead class="bg-success">
                                    <th style="color: #fff">COD</th>
                                    <th style="color: #fff">DNI</th>
                                    <th style="color: #fff">NOMBRES</th>
                                    <th style="color: #fff">REG. LAB.</th>
                                    <th style="color: #fff">UNI. ORG</th>
                                    <th style="color: #fff">I. LABORES</th>
                                    <th style="color: #fff">C. LABORES</th>
                                    <th style="color: #fff">ESTADO</th>
                                    <th style="color: #fff">OPCIONES</th>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#aislamientos').DataTable({
                proccesing : true,
                info:true,
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                "order": [[ 0, "DESC" ]],
                responsive:true,
                autoWidth:false,
                processing:true,
                info:true,
                "pageLength":5,
                "aLengthMenu":[[5,10,15,-1],[5,10,15,"Todos"]],
                "ajax":"{{route('tabla.aislamientos')}}",
                "columns" : [
                    {data:'codigo_persona'},
                    {data:'documento_persona'},
                    {data:'nombre_persona'},
                    {data:'reglab_persona'},
                    {data:'uniorg_persona'},
                    {data:'fecha_inicio_persona'},
                    {data:'fecha_cese_persona'},
                    {data:'estado_persona'},
                    {data:'detalles'}
                ]
            });
     
        });
    </script>
@endsection
