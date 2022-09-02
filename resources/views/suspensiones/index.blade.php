@extends('layouts.app')
@section('title')
    Suspensiones |
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Personal Con Suspensiones Registradas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-hover mt-2" id="personal">
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
            $('#personal').DataTable({
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
