@extends('layouts.main', ['activePage' => 'impresoras', 'titlePage' => 'Nueva Impresora'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('impresoras.store') }}" method="post" class="form-horizontal">
          @csrf
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Impresora</h4>
              <p class="card-category">Ingresar datos</p>
            </div>
            <div class="card-body">
              {{-- @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
              @endforeach
              </ul>
            </div>
            @endif --}}
            <div class="row">
              <label for="name" class="col-sm-2 col-form-label">Nombre</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre de la impresora" value="{{ old('name') }}" autofocus>
                @if ($errors->has('nombre'))
                <span class="error text-danger" for="input-name">{{ $errors->first('nombre') }}</span>
                @endif
              </div>
            </div>
            <div class="row">
              <label for="name" class="col-sm-2 col-form-label">Nombre Red</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="nombrered" placeholder="Ingrese el nombre en red" value="{{ old('nombrered') }}" autofocus>
                @if ($errors->has('nombreRed'))
                <span class="error text-danger" for="input-name">{{ $errors->first('nombreRed') }}</span>
                @endif
              </div>
            </div>
            <div class="row">
              <label for="roles" class="col-sm-2 col-form-label">Ubicaciones</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <div class="tab-content">
                    <div class="tab-pane active">
                      <table class="table">
                        <tbody>
                          @foreach ($ubicaciones as $id => $ubicacion)
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" name="ubicaciones[]" value="{{ $id }}">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>
                              {{ $ubicacion }}
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
          </div>
          <!--Footer-->
          <div class="card-footer ml-auto mr-auto">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <!--End footer-->
      </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection