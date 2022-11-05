@extends('layouts.main', ['activePage' => 'comisionesV', 'titlePage' => 'comisiones Vendedores'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Total total0
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">attach_money</i>
            </div>
            <p class="card-category">Total Subtotal</p>
            <h3 class="card-title">$ {{number_format($comisionesTotales->SUBTOTAL0, 2, ".", ",")}}</h3>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
      total comisiones
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">attach_money</i>
            </div>
            <p class="card-category">Total Comisiones</p>
            <h3 class="card-title">$ {{number_format($comisionesTotales->COMISION, 2, ".", ",")}}</h3>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>-->
      <div class="col-md-12">
        <div class="row">
          <!--<div class="col-m2-12">
            <a class="btn btn-info" href="{{ route('registroAlmacen') }}">Registrar Documento</a>
          </div>-->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Comisiones Vendedores</h4>
                <p class="card-category">Reporte por vendedor</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-center thead-dark">
                      <th>Vendedor</th>
                      <th>Subtotal</th>
                      <th>Comision</th>
                    </thead>
                    <tbody class="text-center">
                      @foreach ($comisiones as $comision)
                      @if($comision->NOMBRE)
                      <tr>
                        <td>{{$comision->NOMBRE}}</td>
                        <td>{{number_format($comision->SUBTOTAL0, 2, ".", ",")}}</td>
                        <td>{{number_format($comision->COMISION, 2, ".", ",")}}</td>
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