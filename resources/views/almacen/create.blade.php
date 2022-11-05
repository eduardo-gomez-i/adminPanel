@extends('layouts.main', ['activePage' => 'almacen', 'titlePage' => 'Registro Almacen'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('registroAlmacenPost') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Registro Almacen</h4>
                            <p class="card-category">{{ $hoy }}</p>
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
                        <div class="row pb-3">
                            <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="usuario" placeholder="Ingrese el usuario" value="{{ old('usuario') }}" autofocus>
                                @if ($errors->has('usuario'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('usuario') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <label for="name" class="col-sm-2 col-form-label">Documento</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="documento" placeholder="Ingrese el no. documento" value="{{ old('nombrered') }}" autofocus>
                                @if ($errors->has('documento'))
                                <span class="error text-danger" for="input-name">{{ $errors->first('documento') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                    <!--End footer-->
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection