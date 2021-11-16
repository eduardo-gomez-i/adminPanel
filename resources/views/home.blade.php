@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

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
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
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
            <!-- TICKET PROMEDIO -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-twitter"></i>
                        </div>
                        <p class="card-category">TICKET PROMEDIO</p>
                        <h3 class="card-title">$ {{number_format($ticketPromedio, 2, ".", ",")}}</h3>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <!-- VENTAS DEL DIA -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div>
                        <p class="card-category">VENTAS DEL DIA</p>
                        <h3 class="card-title">$ {{number_format($ventasTotalesHoy, 2, ".", ",")}}</h3>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <!-- VENTAS DEL MES -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div>
                        <p class="card-category">VENTAS DEL MES</p>
                        <h3 class="card-title">$ {{number_format($ventasMes, 2, ".", ",")}}</h3>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <!-- CRECIMIENTO -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
                        </div>
                        <p class="card-category">CRECIMIENTO</p>
                        <h3 class="card-title">%{{number_format($crecimiento, 2, ".", ",")}}</h3>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <!-- META DE CRECIMIENTO -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
                        </div>
                        <p class="card-category">META DE CRECIMIENTO 10%</p>
                        <h3 class="card-title">%{{number_format($metaCrecimiento, 2, ".", ",")}}</h3>
                    </div>
                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>
            <!-- VENDEDORES -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Vendedores</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Ventas</th>
                                    <th>Documentos</th>
                                    <th>Partidas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentosVendedor as $ven)
                                <tr class="text-center">
                                    <td>{{$ven->NOMBRE}}</td>
                                    <td>$ {{number_format($ven->documentos_sum, 2, ".", ",")}}</td>
                                    <td>{{$ven->documentos_count}}</td>
                                    <td>{{$ven->partidas_count}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- TOP 5 DEL DIA -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">TOP 5 vendedores del dia</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Vendedor</th>
                                    <th>Ventas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($TopHoy as $toph)
                                <tr class="text-center">
                                    <td>{{$toph->NOMBRE}}</td>
                                    <td>$ {{number_format($toph->TOTAL, 2, ".", ",")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TOP 5 DEL MES -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">TOP 5 vendedores del mes</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Vendedor</th>
                                    <th>Ventas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($TopMes as $topm)
                                <tr class="text-center">
                                    <td>{{$topm->NOMBRE}}</td>
                                    <td>$ {{number_format($topm->TOTAL, 2, ".", ",")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ORDENES RECIENTES -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ordenes recientes</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Folio</th>
                                    <th>Nombre</th>
                                    <th class="col-3">Fecha</th>
                                    <th>hora</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentosRecientes as $docR)
                                <tr class="text-center">
                                    <td>{{$docR->CAJAID}}</td>
                                    <td>{{$docR->clientes->NOMBRE}}</td>
                                    <td>{{$docR->FECHA}}</td>
                                    <td>{{$docR->HORA}}</td>
                                    <td>${{number_format($docR->CANTIDAD, 2, ".", ",")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- CANCELACIONES -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Cancelaciones</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Folio</th>
                                    <th>Nombre</th>
                                    <th class="col-3">Fecha</th>
                                    <th>hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($canceladas as $can)
                                <tr class="text-center">
                                    <td>{{ $can->NUMERO }}</td>
                                    <td>{{ !empty($can->clientes) ? $can->clientes->NOMBRE:'' }}</td>
                                    <td>{{$can->FECHA}}</td>
                                    <td>{{$can->HORA}}</td>
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
@endsection