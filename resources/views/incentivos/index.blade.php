@extends('layouts.main', ['activePage' => 'Incentivos', 'titlePage' => 'Incentivos'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Puntualidad</h4>
                <p class="card-category">Reporte de puntualidad del mes</p>
              </div>
              <div class="card-body">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Puntualidad</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($AsistenciaReporte as $item)
                    <tr>
                      <th scope="row">{{ $item['trabajador'] }}</th>
                      <td>{{ $item['bono'] == 1 ? $item['dias_puntuales'] * 50 : '-' }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Asistencia perfecta</h4>
                <p class="card-category">Reporte de asistencia perfecta del mes</p>
              </div>
              <div class="card-body">
                <table class="table">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Bono</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($puntualidadReporte as $item)
                    <tr>
                      <th scope="row">{{ $item['trabajador'] }}</th>
                      <td>{{ $item['bono'] }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Productividad</h4>
                <p class="card-category">Reporte de productividad del mes</p>
              </div>
              <div class="card-body">
                <h1>hola</h1>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection