<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('Panel') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      @can('dashboard')
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @endcan
      <li class="nav-item {{ ($activePage == 'reporte' || $activePage == 'reportes') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#reportes" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('img/laravel.svg') }}"></i>
          <p>{{ __('Reportes') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="reportes">
          <ul class="nav">
            @can('VENTAS_FERREMOBIL')
            <li class="nav-item{{ $activePage == 'ventas' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('ventas') }}">
                <i class="material-icons">library_books</i>
                <p>{{ __('Ventas') }}</p>
              </a>
            </li>
            @endcan
            @can('CORTE_DE_CAJA')
            <li class="nav-item{{ $activePage == 'cajas' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('cajas.index') }}">
                <i class="material-icons">library_books</i>
                <p>{{ __('Cajas') }}</p>
              </a>
            </li>
            @endcan
            @can('SURTIDO_ALMACEN')
            <li class="nav-item{{ $activePage == 'almacen' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('almacen') }}">
                <i class="material-icons">library_books</i>
                <p>{{ __('Almacen') }}</p>
              </a>
            </li>
            @endcan
            @can('COMISION_VENDEDORES')
            <li class="nav-item{{ $activePage == 'comisionesV' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('comisionesV') }}">
                <i class="material-icons">library_books</i>
                <p>{{ __('Comisiones Vendedores') }}</p>
              </a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'etiquetas' || $activePage == 'etiquetas') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#etiquetas" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('img/laravel.svg') }}"></i>
          <p>{{ __('Etiquetas') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="etiquetas">
          <ul class="nav">
            @can('post_index')
            <li class="nav-item{{ $activePage == 'documentos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('documentos.index') }}">
                <i class="material-icons">library_books</i>
                <p>{{ __('Documentos') }}</p>
              </a>
            </li>
            @endcan
            @can('impresoras_index')
            <li class="nav-item{{ $activePage == 'impresoras' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('impresoras.index') }}">
                <i class="material-icons">local_printshop</i>
                <p>{{ __('Impresoras') }}</p>
              </a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      @can('user_index')
      <li class="nav-item{{ $activePage == 'users' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="material-icons">content_paste</i>
          <p>Usuarios</p>
        </a>
      </li>
      @endcan
      @can('permission_index')
      <li class="nav-item{{ $activePage == 'permissions' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('permissions.index') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Permisos') }}</p>
        </a>
      </li>
      @endcan
      @can('role_index')
      <li class="nav-item{{ $activePage == 'roles' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('roles.index') }}">
          <i class="material-icons">location_ons</i>
          <p>{{ __('Roles') }}</p>
        </a>
      </li>
      @endcan
      @can('ADMIN_FERREMOBIL')
      <li class="nav-item{{ $activePage == 'ferremobil' ? ' active' : '' }}">
        <a class="nav-link" href="https://ferremobil.com/admin">
          <i class="material-icons">admin_panel_settings</i>
          <p>{{ __('Admin ferremobil') }}</p>
        </a>
      </li>
      @endcan
      @can('CHECADOR')
      <li class="nav-item{{ $activePage == 'Checador' ? ' active' : '' }}">
        <a class="nav-link" href="http://192.168.0.144/checador/login.php">
          <i class="material-icons">admin_panel_settings</i>
          <p>{{ __('Checador') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'Incentivos' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('incentivos.index') }}">
          <i class="material-icons">admin_panel_settings</i>
          <p>{{ __('Modulo incentivos') }}</p>
        </a>
      </li>
      @endcan
      @can('NUEVOS_PRODUCTOS')
      <li class="nav-item{{ $activePage == 'nuevosProductos' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('nuevos.index') }}">
          <i class="material-icons">feed</i>
          <p>{{ __('Nuevos productos') }}</p>
        </a>
      </li>
      @endcan

    </ul>
  </div>
</div>