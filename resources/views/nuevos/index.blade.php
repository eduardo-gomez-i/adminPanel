@extends('layouts.main', ['activePage' => 'nuevosProductos', 'titlePage' => 'nuevos Productos'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Nuevos Productos</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                <form action="{{ route('nuevos.exportar') }}" method="post">
                  @csrf
                  <div class="col-sm-7">
                    <input type="date" class="form-control" name="fecha" autofocus>
                    @if ($errors->has('nombre'))
                    <span class="error text-danger" for="input-name">{{ $errors->first('nombre') }}</span>
                    @endif
                  </div>
                  <button type="submit" class="btn btn-sm btn-facebook">Exportar</button>
                </form>
                @can('role_create')
                @endcan
              </div>
            </div>
          </div>
          <!--Footer-->
          <div class="card-footer mr-auto">

          </div>
          <!--End footer-->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection