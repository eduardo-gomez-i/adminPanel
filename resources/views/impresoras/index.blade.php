@extends('layouts.main', ['activePage' => 'impresoras', 'titlePage' => 'Impresoras'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Impresoras</h4>
                <p class="card-category">Impresoras registradas</p>
              </div>
              <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success" role="success">
                  {{ session('success') }}
                </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    @can('user_create')
                    <a href="{{ route('impresoras.create') }}" class="btn btn-sm btn-facebook">Añadir impresora</a>
                    @endcan
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Nombre red</th>
                      <th>Roles</th>
                      <th class="text-right">Acciones</th>
                    </thead>
                    <tbody>
                      @foreach ($impresoras as $impresora)
                      <tr>
                        <td>{{ $impresora->id }}</td>
                        <td>{{ $impresora->nombre }}</td>
                        <td>{{ $impresora->nombrered }}</td>
                        <td>
                          @forelse ($impresora->ubicaciones as $ubicacion)
                          <span class="badge badge-info">{{ $ubicacion->nombre }}</span>
                          @empty
                          <span class="badge badge-danger">Sin ubicaciones</span>
                          @endforelse
                        </td>
                        <td class="td-actions text-right">
                          @can('user_edit')
                          <a href="{{ route('impresoras.edit', $impresora->id) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                          @endcan
                          @can('user_destroy')
                          <form action="{{ route('impresoras.destroy', $impresora->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Seguro?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" rel="tooltip">
                              <i class="material-icons">close</i>
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
              <div class="card-footer mr-auto">
                {{ $impresoras->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection