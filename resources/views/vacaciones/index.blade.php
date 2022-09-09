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
                        <div class="row">
                            <div class="col-md-3">
                                <h5 class="my-4">Filtro por fechas</h5>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="finicio">Fecha de inicio</label>
                                <input type='text' id='start_date' name="min" class="form-control start_date" placeholder='Fecha Inicio' class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="Fecha de Fin">Fecha de fin</label>
                                <input type='text' id='end_date' name="max" class="form-control end_date" placeholder='Fecha fin' class="form-control">
                            </div>
                            <div class="col-md-3 mt-4">
                                <button class="btn btn-primary mt-2" id="filtrar">
                                    Buscar
                                </button>
                            </div>
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
        $('#filtrar').focus();

        $('.start_date').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('.end_date').datepicker({
            format: 'dd-mm-yyyy'
        });

        const table = $('#vacaciones').DataTable({
            proccesing: true,
            info: true,
            "order": [
                [0, "DESC"]
            ],
            responsive: true,
            autoWidth: false,
            processing: true,
            info: true,
            "pageLength": 5,
            "aLengthMenu": [
                [5, 10, 15, -1],
                [5, 10, 15, "Todos"]
            ],
            "ajax": {
                url: "{{route('tabla.vacaciones')}}",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'GET',
                data: function(d) {
                    d.start_date = $('.start_date').val(),
                    d.end_date = $('.end_date').val()
                }
            },
            "columns": [{
                    data: 'codigo_persona'
                },
                {
                    data: 'documento_persona'
                },
                {
                    data: 'nombre_persona'
                },
                {
                    data: 'reglab_persona'
                },
                {
                    data: 'uniorg_persona'
                },
                {
                    data: 'fecha_inicio'
                },
                {
                    data: 'fecha_fin'
                },
                {
                    data: 'detalles'
                }
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

        $('#filtrar').click(function() {
            table.draw();
        })
    });
</script>
@endsection
