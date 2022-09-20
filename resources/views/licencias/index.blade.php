@extends('layouts.app')
@section('title')
Licencias |
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Personal Con Licencias Registradas</h3>
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
                                        <td><a href="{{route('licencias.export')}}">Exportar</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table mt-2" id="licencias">
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
                                        @can('EDITAR-LICENCIAS')
                                        <th style="color: #fff" colspan="2" class="text-center">OPCIONES</th>
                                        @endcan
                                    </thead>
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
            $('#licencias').DataTable({
                proccesing : true,
                info:true,
                "order": [[ 0, "DESC" ]],
                responsive:true,
                autoWidth:false,
                processing:true,
                info:true,
                "pageLength":5,
                "aLengthMenu":[[5,10,15,-1],[5,10,15,"Todos"]],
                "ajax":"{{route('tabla.licencias')}}",
                "columns" : [
                    // {data:'codigo_persona'},
                    {data: 'documento_persona'},
                    {data: 'nombre_persona'},
                    // {data:'reglab_persona'},
                    // {data:'uniorg_persona'},
                    {data: 'fecha_inicio'},
                    {data: 'fecha_fin'},
                    {data: 'inicial'},
                    {data: 'anio_periodo'},
                    {data: 'docsus'},
                    {data: 'detalles'},
                    {data: 'borrar'}
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
        var url = '<?= route('desactivar.registro') ?>';
        swal({
                title: 'Seguro de eliminar este Registro?',
                text: "Si eliminas este registro no podrás recuperarlo",
                icon: "warning",
                showCancelButton: true,
                buttons: true,
                buttons: {
                    cancel: 'No, eliminar',
                    confirm: "Si, Eliminar",
                },
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    $.get(url, {
                        id: id
                    }, function(data) {
                        if (data.code == 1) {
                            swal({
                                title: 'Eliminado!',
                                text: "Se elimino el registro",
                                icon: "success",
                            })
                            window.location.reload(true);
                        } else if (data.code == 0) {
                            swal({
                                title: 'Eliminado!',
                                text: data.msn,
                                icon: "error",
                                showCancelButton: true,
                                dangerMode: true,
                            })
                        }
                    }, 'json');
                }
            });
    });
    </script>
@endsection
