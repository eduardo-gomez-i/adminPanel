@extends('layouts.main', ['activePage' => 'almacen', 'titlePage' => 'almacen'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <!--<div class="col-m2-12">
            <a class="btn btn-info" href="{{ route('registroAlmacen') }}">Registrar Documento</a>
          </div>-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Almacen</h4>
                <p class="card-category">Reporte por emisor</p>
              </div>
              <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success" role="success">
                  {{ session('success') }}
                </div>
                @endif
                <div class="col-md-12 text-center">
                  <form action="{{ route('registroAlmacenPost') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="row pb-3">
                      <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="userInput" onkeypress="return enter(event)" name="usuario" placeholder="Ingrese el usuario" value="{{ old('usuario') }}" autofocus>
                        @if ($errors->has('usuario'))
                        <span class="error text-danger" for="input-name">{{ $errors->first('usuario') }}</span>
                        @endif
                      </div>
                    </div>
                    <div class="row">
                      <label for="name" class="col-sm-2 col-form-label">Documento</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="docInput" name="documento" placeholder="Ingrese el no. documento" value="{{ old('nombrered') }}" autofocus>
                        @if ($errors->has('documento'))
                        <span class="error text-danger" for="input-name">{{ $errors->first('documento') }}</span>
                        @endif
                      </div>
                    </div>
                    <!--Footer-->
                    <div class="ml-auto mr-auto mt-auto text-center">
                      <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                    <!--End footer-->
                  </form>
                </div>
                <div class="row">
                  <div class="col-6">
                    <h3>Busqueda</h3>
                    <form action="{{ route('busquedaAlmacen') }}" method="get">
                      {{csrf_field()}}
                      <div class="form-group">
                        <label for="Service">Folio:</label>
                        <input type="text" name="folio" class="form-control">
                        <button type="submit" class="btn btn btn-success">Buscar</button>
                      </div>
                    </form>
                  </div>
                  <div class="card col-6">
                    <div class="card-body">
                      <h5 class="card-title">Mejor Colaborador</h5>
                      <table class="table">
                        <thead>
                          <th>Nombre</th>
                          <th>Documentos</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $mejorColaborador->emisor ?? '' }}</td>
                            <td>{{ $mejorColaborador->docs ?? '' }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-center thead-dark">
                      <th>Folio</th>
                      <th>Emisor</th>
                      <th>Estado</th>
                      <th>Partidas</th>
                      <th>Cliente</th>
                    </thead>
                    <tbody class="text-center">
                      @foreach ($reporteF as $rep)
                      @if(!isset($rep->estado))
                      <tr class="table-danger">
                        <td>{{$rep->FOLDIARIO}}</td>
                        <td>{{$rep->EMISOR}}</td>
                        <td>
                          Por Surtir
                        </td>
                        <td>{{$rep->PART}}</td>
                        <td>{{ !empty($rep->clientes) ? $rep->clientes->NOMBRE:'' }}</td>
                      </tr>
                      @else
                      <tr class="@if ($rep->estado == 0)
                                                    table-warning
                                                    @elseif ($rep->estado == 1)
                                                    table-success
                                                    @elseif ($rep->estado == 2)
                                                    table-success
                                                    @endif">
                        <td>{{$rep->FOLDIARIO}}</td>
                        <td>{{$rep->emisor}}</td>
                        <td>
                          @if ($rep->estado == 0)
                          surtiendo
                          @elseif ($rep->estado == 1)
                          surtido
                          @elseif ($rep->estado == 2)
                          entregado
                          @elseif ($rep->estado == 3)
                          entregado
                          @endif
                        </td>
                        <td>{{$rep->partidas}}</td>
                        <td>{{ !empty($rep->CLIENTE) ? $rep->CLIENTE:' ' }}</td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="application/javascript">
  function enter(e) {
    if (e.which === 13) {
      document.getElementById("docInput").focus();
      return false;
    }
  }
</script>
@endsection