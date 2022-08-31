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
                                    <form class="my-4" method="POST" action="{{ route('general.consultar') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col">
                                                <label for="codigo">CÓDIGO</label>
                                                <input type="text" class="form-control" placeholder="CÓDIGO"
                                                    id="codigo" name="codigo">
                                            </div>
                                            <div class="col">
                                                <label for="dni">DNI</label>
                                                <input type="text" class="form-control" placeholder="DNI" id="dni"
                                                    name="dni">
                                            </div>
                                            <div class="col">
                                                <label for="paterno">AP. PATERNO</label>
                                                <input type="text" class="form-control" placeholder="APELLIDO PATERNO"
                                                    id="paterno" name="paterno">
                                            </div>
                                            <div class="col">
                                                <label for="materno">AP. MATERNO</label>
                                                <input type="text" class="form-control" placeholder="APELLIDO MATERNO"
                                                    id="materno" name="materno">
                                            </div>
                                        </div>
                                        <div class="form-row my-4">
                                            <div class="col">
                                                <button type="submit" class="btn btn-success">Búscar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h4 class="my-4">Resultados de la Búsqueda</h4>
                            @if ($notification = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $notification }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table class="table table-bordered table-hover mt-2" id="users">
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
                                    @if ($respuesta = Session::get('resp'))
                                        @foreach ($respuesta as $resp)
                                            <tr>
                                                <td>{{ $resp['CODIGO'] }}</td>
                                                <td>{{ $resp['DOC_IDENTIDAD'] }}</td>
                                                <td>{{ $resp['NOMBRE_COMPLETO'] }}</td>
                                                <td>{{ $resp['TIPO_TRABAJADOR'] }}</td>
                                                <td>{{ $resp['CENTROCOSTO'] }}</td>
                                                <td>{{ $resp['FEC_INGRESO'] }}</td>
                                                @if ($resp['FEC_CESE'] == '')
                                                    <td>
                                                        LABORANDO
                                                    </td>
                                                @else
                                                    <td>{{ $resp['FEC_CESE'] }}</td>
                                                @endif
                                                @if ($resp['ESTADO'] == 'INACTIVO')
                                                    <td>
                                                        <span class="badge badge-danger">
                                                            {{ $resp['ESTADO'] }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-danger">
                                                            No modificable
                                                        </span>
                                                    </td>
                                                @elseif ($resp['ESTADO'] == 'ACTIVO')
                                                    <td>
                                                        <span class="badge badge-success">
                                                            {{ $resp['ESTADO'] }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" href="#">Agregar</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="9">Sin Resultados</td>
                                        </tr>
                                    @endif
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
            $('#users').DataTable({
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
