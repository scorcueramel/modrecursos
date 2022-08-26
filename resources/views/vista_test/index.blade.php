@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Consulta de Registros</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h4>Campos de Búsqueda</h4>
                                    <form>
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="codigo">CÓDIGO</label>
                                                <input type="text" class="form-control" placeholder="CÓDIGO" id="codigo">
                                            </div>
                                            <div class="col">
                                                <label for="dni">DNI</label>
                                                <input type="text" class="form-control" placeholder="DNI" id="dni">
                                            </div>
                                            <div class="col">
                                                <label for="paterno">AP. PATERNO</label>
                                                <input type="text" class="form-control" placeholder="APELLIDO PATERNO" id="paterno">
                                            </div>
                                            <div class="col">
                                                <label for="materno">AP. MATERNO</label>
                                                <input type="text" class="form-control" placeholder="APELLIDO MATERNO" id="materno">
                                            </div>
                                            <div class="col d-flex justify-content-end">
                                                <button type="submit" class="btn btn-warning mb-2">Búscar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-striped mt-2" id="usuarios">
                                <thead class="bg-success">
                                    <th style="display: none">CÓDIGO</th>
                                    <th style="color: #fff">DNI</th>
                                    <th style="color: #fff">APELLIDOS Y NOMBRES</th>
                                    <th style="color: #fff">REGIMEN LABORAL</th>
                                    <th style="color: #fff">UNIDAD ORGANICA</th>
                                    <th style="color: #fff">INICIO DE LABORES</th>
                                    <th style="color: #fff">CESE DE LABORES</th>
                                    <th style="color: #fff">ESTADO</th>
                                    <th style="color: #fff">OPCIONES</th>
                                </thead>
                                <tbody>
                                    @foreach ($rpta as $r)
                                        <tr>
                                            <td>{{$r["contenido"][0]["FEC_INGRESO"]}}</td>
                                        </tr>
                                    @endforeach
                                        
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
        $('.frmDelete').submit(function(e) {
            e.preventDefault();
            swal({
                    title: 'Seguro de eliminar este rol?',
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
                .then((willDelete) => {
                    if (willDelete) {
                        this.submit();
                        swal("El registro de elimino de la base de datos", {
                            icon: "success",
                        });
                    }
                });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#roles').DataTable({
                responsive: true,
                autoWidth: false,
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
                    "zeroRecords": "Aún no hay registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar: ",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
@endsection
