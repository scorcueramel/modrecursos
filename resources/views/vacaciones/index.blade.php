@extends('layouts.app')

@section('title')
Vacaciones |
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Personal Con Vacaciones Registradas</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <table border="0" cellspacing="5" cellpadding="5" class="ml-3">
                                <tbody>
                                    <tr>
                                        <td>Desde:</td>
                                        <td><input type="date" id="min" name="min" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>Hasta:</td>
                                        <td><input type="date" id="max" name="max" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover mt-2" id="vacaciones">
                                    <thead class="bg-info">
                                        <th style="color: #fff">COD</th>
                                        <th style="color: #fff">DNI</th>
                                        <th style="color: #fff">NOMBRES</th>
                                        <th style="color: #fff">REG. LAB.</th>
                                        <th style="color: #fff">UNI. ORG</th>
                                        <th style="color: #fff">F. INICIO</th>
                                        <th style="color: #fff">F. FIN</th>
                                        <th style="color: #fff">DIAS</th>
                                        <th style="color: #fff">OPCIONES</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
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
            $('#vacaciones').DataTable({
                proccesing : true,
                info:true,
                "order": [[ 0, "desc" ]],
                responsive:true,
                autoWidth:false,
                processing:true,
                info:true,
                "pageLength":5,
                "aLengthMenu":[[5,10,15,-1],[5,10,15,"Todos"]],
                "ajax":"{{route('tabla.vacaciones')}}",
                "columns" : [
                    {data:'codigo_persona'},
                    {data:'documento_persona'},
                    {data:'nombre_persona'},
                    {data:'reglab_persona'},
                    {data:'uniorg_persona'},
                    {data:'fecha_inicio'},
                    {data:'fecha_fin'},
                    {data:'diaspermiso'},
                    {data:'detalles'}
                ],
                "language": {
                    "lengthMenu": "Mostrar " +
                        `<select class="custom-select custom-select-sm form-control form-control-sm">
                            <option value='5'>5</option>
                            <option value='10'>10</option>
                            <option value='15'>15</option>
                            <option value='20'>20</option>
                            <option value='25'>25</option>
                            <option value='-1'>Todos</option>
                        </select>` +
                        " registros por página",
                    "zeroRecords": "Sin Resultados Actualmente",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "Sin Resultados",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar: ",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });

        });
    </script>
@endsection
