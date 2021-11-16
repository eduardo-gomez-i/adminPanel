@extends('layouts.main', ['activePage' => 'almacen', 'titlePage' => 'almacen'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
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
@endsection