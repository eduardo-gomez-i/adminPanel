@extends('layouts.main', ['activePage' => 'documentos', 'titlePage' => 'documentos'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">documentos</h4>
                <p class="card-category">documentos registrados</p>
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
                    <a href="{{ route('documentos.create') }}" class="btn btn-sm btn-facebook">Añadir documento</a>
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
                      @foreach ($documentos as $documento)
                      <tr>
                        <td>{{ $documento->id }}</td>
                        <td>{{ $documento->nombre }}</td>
                        <td>{{ $documento->nombrered }}</td>
                        <td>
                          @forelse ($documento->ubicaciones as $ubicacion)
                          <span class="badge badge-info">{{ $ubicacion->nombre }}</span>
                          @empty
                          <span class="badge badge-danger">Sin ubicaciones</span>
                          @endforelse
                        </td>
                        <td class="td-actions text-right">
                          @can('user_edit')
                          <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                          @endcan
                          @can('user_destroy')
                          <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Seguro?')">
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
                {{ $documentos->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection