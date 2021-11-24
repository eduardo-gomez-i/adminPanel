@extends('layouts.main', ['activePage' => 'ventas', 'titlePage' => 'ventas'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- PARTIDAS -->
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">content_copy</i>
            </div>
            <p class="card-category">PARTIDAS</p>
            <h3 class="card-title">{{ $contPartidas }}</h3>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
      <!-- DOCUMENTOS -->
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">content_copy</i>
            </div>
            <p class="card-category">DOCUMENTOS</p>
            <h3 class="card-title">{{ $contDocumentos }}</h3>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
      <!-- CANCELADOS -->
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">info_outline</i>
            </div>
            <p class="card-category">CANCELADOS</p>
            <h3 class="card-title">{{ $countCancelados }}</h3>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
      <!-- VENTAS DEL DIA -->
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">attach_money</i>
            </div>
            <p class="card-category">VENTAS DEL DIA</p>
            <h3 class="card-title">$ {{number_format($ventasTotalesHoy, 2, ".", ",")}}</h3>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
      <!-- TICKET PROMEDIO -->
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">confirmation_number</i>
            </div>
            <p class="card-category">TICKET PROMEDIO</p>
            <h3 class="card-title">$ {{number_format($ticketPromedio, 2, ".", ",")}}</h3>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
      <!-- TABLA VENTAS -->
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Ventas</h4>
                <p class="card-category">Reporte Documentos - Partidas por vendedor</p>
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
                      <th>nombre</th>
                      <th>7</th>
                      <th>8</th>
                      <th>9</th>
                      <th>10</th>
                      <th>11</th>
                      <th>12</th>
                      <th>13</th>
                      <th>14</th>
                      <th>15</th>
                      <th>16</th>
                      <th>17</th>
                      <th>18</th>
                      <th>Total</th>
                      <th>Total<br>Ventas</th>
                    </thead>
                    <tbody class="text-center">
                      @foreach($reporte as $l => $rep)
                      <tr>
                        <td>{{$rep->NOMBRE}}</td>

                        @if($rep->a7am != 0)
                        <td>{{$rep->a7am}} | {{$reporte2[$l]->b7am}}</td>
                        @else
                        <td>- | -</td>
                        @endif

                        @if($rep->a8am != 0)
                        <td>{{$rep->a8am}} | {{$reporte2[$l]->b8am}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a9am != 0)
                        <td>{{$rep->a9am}} | {{$reporte2[$l]->b9am}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a10am != 0)
                        <td>{{$rep->a10am}} | {{$reporte2[$l]->b10am}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a11am != 0)
                        <td>{{$rep->a11am}} | {{$reporte2[$l]->b11am}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a12pm != 0)
                        <td>{{$rep->a12pm}} | {{$reporte2[$l]->b12pm}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a13pm != 0)
                        <td>{{$rep->a13pm}} | {{$reporte2[$l]->b13pm}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a14pm != 0)
                        <td>{{$rep->a14pm}} | {{$reporte2[$l]->b14pm}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a15pm != 0)
                        <td>{{$rep->a15pm}} | {{$reporte2[$l]->b15pm}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a16pm != 0)
                        <td>{{$rep->a16pm}} | {{$reporte2[$l]->b16pm}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a17pm != 0)
                        <td>{{$rep->a17pm}} | {{$reporte2[$l]->b17pm}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->a18pm != 0)
                        <td>{{$rep->a18pm}} | {{$reporte2[$l]->b18pm}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        @if($rep->docTot != 0)
                        <td>{{$rep->docTot}} | {{$reporte2[$l]->parTot}}</td>
                        @else
                        <td>- | -</td>
                        @endif
                        <td>${{number_format($rep->sumTot, 2, ".", ",")}}</td>
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
      <!-- GRAFICA VENTAS -->
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Grafica por vendedor</h4>
                <p class="card-category">Reporte Documentos - Partidas - ventas por vendedor</p>
              </div>
              <div class="card-body">
                <canvas id="ventas" height="280" width="600"></canvas>
                <canvas id="canvas" height="280" width="600"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
<script>
  var nombres = <?php echo $nombres; ?>;
  var ventas = <?php echo $ventas; ?>;
  var documentos = <?php echo $documentos; ?>;
  var partidas = <?php echo $partidas; ?>;

  var barChartData = {
    labels: nombres,
    datasets: [{
      label: 'Ventas',
      backgroundColor: "rgb(119, 221, 119)",
      data: ventas,
      borderColor: 'rgb(119, 221, 119)',
    }, ]
  };

  var barChartData2 = {
    labels: nombres,
    datasets: [{
        label: 'Documentos',
        backgroundColor: "rgb(255, 179, 90)",
        data: documentos,
        borderColor: 'rgb(255, 179, 90)',
      },
      {
        label: 'Partidas',
        backgroundColor: "rgb(119, 158, 203)",
        data: partidas,
        borderColor: 'rgb(119, 158, 203)',
      },
    ]
  };

  window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
      type: 'bar',
      data: barChartData2,
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Yearly User Joined'
        }
      }
    });

    var ctx2 = document.getElementById("ventas").getContext("2d");
    window.myBar = new Chart(ctx2, {
      type: 'bar',
      data: barChartData,
      options: {
        scales: {
          y: {
            ticks: {
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return '$' + (value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
              }
            }
          },
        },
        responsive: true,
        title: {
          display: true,
          text: 'Yearly User Joined'
        }
      }
    });

  };
</script>
@endsection