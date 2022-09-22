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
                                    <tr>
                                        <td><a href="{{route('vacaciones.export')}}">Exportar</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table mt-2" id="vacaciones">
                                        <thead class="bg-info">
                                        <!-- {{--                                        <th style="color: #fff">COD</th>--}} -->
                                        <th style="color: #fff">DCUMENTO IDENTIDAD</th>
                                        <th style="color: #fff">NOMBRES</th>
                                        <!-- {{--                                        <th style="color: #fff">REG. LAB.</th>--}}
                                        {{--                                        <th style="color: #fff">UNI. ORG</th>--}} -->
                                        <th style="color: #fff">F. INICIO</th>
                                        <th style="color: #fff">F. FIN</th>
                                        <th style="color: #fff">DIAS</th>
                                        <th style="color: #fff">PERIODO</th>
                                        <th style="color: #fff">DOCUMENTO</th>
                                        @can('EDITAR-VACACIONES')
                                            <th style="color: #fff" colspan="2" class="text-center">OPCIONES</th>
                                        @endcan
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#vacaciones').DataTable({
                proccesing: true,
                info: true,
                "order": [
                    [0, "desc"]
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
                "ajax": "{{route('tabla.vacaciones')}}",
                "columns": [
                    // {data:'codigo_persona'},
                    {
                        data: 'documento_persona'
                    },
                    {
                        data: 'nombre_persona'
                    },
                    // {data:'reglab_persona'},
                    // {data:'uniorg_persona'},
                    {
                        data: 'fecha_inicio'
                    },
                    {
                        data: 'fecha_fin'
                    },
                    {
                        data: 'inicial'
                    },
                    {
                        data: 'anio_periodo'
                    },
                    {
                        data: 'docsus'
                    },
                    {
                        data: 'detalles'
                    },
                    {
                        data: 'borrar'
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
        });

        $(document).on('click', '#borrar', function() {
            var id = $(this).data('id');
            // alert(id);
            {{--var url = '<?= route('desactivar.registro') ?>';--}}
            Swal.fire({
                title: '¿Borrar el Registro?',
                html: `<label for="motivo">Indica el Documento Sustentatorio</label>
            <textarea type="text" id="motivo" class="swal2-textarea">`,
                text: "Tener en cuenta que, al borrar este registro no lo podrás ver!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Borrar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        data: {motivo: $("textarea[id='motivo']").val()},
                        url: 'delete/'+id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        beforeSend: function () {
                            Swal.fire({
                                allowOutsideClick: false,
                                icon: 'info',
                                text: 'Espere por favor...'
                            });
                            Swal.showLoading();
                        },
                        complete: function () {

                        },
                        success: function (result) {
                            if (result.code == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Eliminado!',
                                    text: result.msn
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error no contemplado',
                                    text: result.msn
                                });
                            }
                        },
                        error: function (result) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al enviar',
                                text: result.responseText
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
