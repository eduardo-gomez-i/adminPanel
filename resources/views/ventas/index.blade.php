@extends('layouts.main', ['activePage' => 'ventas', 'titlePage' => 'ventas'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
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
    </div>
  </div>
</div>
@endsection