@extends('layouts.main', ['activePage' => 'users', 'titlePage' => 'Nuevo usuario'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
          @csrf
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Usuario</h4>
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
            <div class="row pb-2">
              <label for="name" class="col-sm-2 col-form-label">Nombre</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="name" placeholder="Ingrese su nombre" value="{{ old('name') }}" autofocus>
                @if ($errors->has('name'))
                <span class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                @endif
              </div>
            </div>
            <div class="row pb-2">
              <label for="username" class="col-sm-2 col-form-label">Nombre de usuario</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="username" placeholder="Ingrese su nombre de usuario" value="{{ old('username') }}">
                @if ($errors->has('username'))
                <span class="error text-danger" for="input-username">{{ $errors->first('username') }}</span>
                @endif
              </div>
            </div>
            <div class="row pb-2">
              <label for="email" class="col-sm-2 col-form-label">Correo</label>
              <div class="col-sm-7">
                <input type="email" class="form-control" name="email" placeholder="Ingrese su correo" value="{{ old('email') }}">
                @if ($errors->has('email'))
                <span class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                @endif
              </div>
            </div>
            <div class="row pb-2">
              <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
              <div class="col-sm-7">
                <input type="password" class="form-control" name="password" placeholder="Contraseña">
                @if ($errors->has('password'))
                <span class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                @endif
              </div>
            </div>
            <div class="row pb-2">
              <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" name="telefono" placeholder="telefono">
                @if ($errors->has('telefono'))
                <span class="error text-danger" for="input-password">{{ $errors->first('telefono') }}</span>
                @endif
              </div>
            </div>
            <div class="row pb-2">
              <label for="fecha_nacimiento" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
              <div class="col-sm-7">
                <input type="date" class="form-control" name="fecha_nacimiento" placeholder="fechaNacimiento">
                @if ($errors->has('fecha_nacimiento'))
                <span class="error text-danger" for="input-password">{{ $errors->first('fecha_nacimiento') }}</span>
                @endif
              </div>
            </div>
            <div class="row pb-2">
              <label for="foto" class="col-sm-2 col-form-label">Foto</label>
              <div class="col-sm-7">
                <input type="file" class="form-control" name="foto" placeholder="foto">
                @if ($errors->has('foto'))
                <span class="error text-danger" for="input-password">{{ $errors->first('foto') }}</span>
                @endif
              </div>
            </div>
            <div class="row pb-2">
              <label for="aficiones" class="col-sm-2 col-form-label">Aficiones o pasatiempos</label>
              <div class="col-sm-7">
                <textarea name="aficiones" id="aficiones" cols="30" rows="10"></textarea>
                @if ($errors->has('aficiones'))
                <span class="error text-danger" for="input-password">{{ $errors->first('aficiones') }}</span>
                @endif
              </div>
            </div>
            <div class="row">
              <label for="roles" class="col-sm-2 col-form-label">Roles</label>
              <div class="col-sm-7">
                <div class="form-group">
                  <div class="tab-content">
                    <div class="tab-pane active">
                      <table class="table">
                        <tbody>
                          @foreach ($roles as $id => $role)
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $id }}">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>
                              {{ $role }}
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