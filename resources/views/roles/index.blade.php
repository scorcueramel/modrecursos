@extends('layouts.app')
@section('title')
Roles |
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Roles</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @can('CREAR-ROLES')
                        <a class="btn btn-info mb-4" href="{{ route('roles.create') }}"><i class="fas fa-cog"></i> Nuevo
                            rol</a>
                        @endcan
                        <table class="table table-striped mt-2" id="roles">
                            <thead class="bg-info">
                                <th style="color: #fff">Rol</th>
                                @can('EDITAR-ROLES')
                                <th style="color: #fff">Acciones</th>
                                @endcan
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('EDITAR-ROLES')
                                        <a class="btn btn-warning" href="{{ route('roles.edit', $role->id) }}"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('BORRAR-ROLES')
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline" class="frmDelete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-light">
                                                <i class="fas fa-minus-square"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
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
                text: "Si eliminas este registro no podr??s recuperarlo",
                icon: "warning",
                showCancelButton: true,
                buttons: true,
                buttons: {
                    cancel: 'No, eliminar',
                    confirm: "Si, Eliminar",
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    this.submit();
                    swal("El registro se elimino de la base de datos", {
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
                    " registros por p??gina",
                "zeroRecords": "A??n no hay registros",
                "info": "Mostrando p??gina _PAGE_ de _PAGES_",
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
