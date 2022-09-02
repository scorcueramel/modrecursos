@can('ver-registers')
<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="{{url('/home')}}">
        <i class="fas fa-tachometer-alt"></i><span>General</span>
    </a>
</li>
@endcan
@can('ver-users')
    <li class="side-menus {{ Request::is('usuarios') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/usuarios')}}">
            <i class="fas fa-users"></i><span>Usuarios</span>
        </a>
    </li>
@endcan
@can('ver-rols')
    <li class="side-menus {{ Request::is('roles') ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/roles')}}">
            <i class="fas fa-cogs"></i><span>Roles</span>
        </a>
    </li>
@endcan
@can('ver-registers')
<li class="side-menus {{ Request::is('vacaciones') ? 'active' : '' }}">
    <a class="nav-link" href="{{url('/vacaciones')}}">
        <i class="fas fa-swimmer"></i><span>Vacaciones</span>
    </a>
</li>
@endcan
@can('ver-registers')
<li class="side-menus {{ Request::is('licencias') ? 'active' : '' }}">
    <a class="nav-link" href="{{url('/licencias')}}">
        <i class="fas fa-id-badge"></i><span>Licencias</span>
    </a>
</li>
@endcan
@can('ver-registers')
<li class="side-menus {{ Request::is('descansosmedicos') ? 'active' : '' }}">
    <a class="nav-link" href="{{url('/descansosmedicos')}}">
        <i class="fas fa-user-injured"></i><span>Descansos Médicos</span>
    </a>
</li>
@endcan
@can('ver-registers')
<li class="side-menus {{ Request::is('aislamientos') ? 'active' : '' }}">
    <a class="nav-link" href="{{url('aislamientos')}}">
        <i class="fas fa-house-user"></i><span>Aislamientos</span>
    </a>
</li>
@endcan
@can('ver-registers')
<li class="side-menus {{ Request::is('suspensiones') ? 'active' : '' }}">
    <a class="nav-link" href="{{url('suspensiones')}}">
        <i class="fas fa-user-slash"></i><span>Suspensiones</span>
    </a>
</li>
@endcan
