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
                            <i class="material-icons">format_list_bulleted</i>
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
                            <i class="material-icons">event</i>
                        </div>
                        <p class="card-category">VENTAS DEL DIA</p>
                        <h3 class="card-title">{{number_format(($ventasTotalesHoy/($ventasTotalesHoyYearPasado == 0 ? 1 : $ventasTotalesHoyYearPasado))*100, 2, ".", ",")}}%</h3>
                    </div>
                    <div class="card-footer">
                        <div class="col-6">
                            <h6>Anterior</h6>
                            <h5 class="text-success">${{number_format($ventasTotalesHoyYearPasado, 2, ".", ",")}}</h5>
                        </div>
                        <div class="col-6">
                            <h6>Actual</h6>
                            <h5 class="text-info">${{number_format($ventasTotalesHoy, 2, ".", ",")}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- VENTAS DEL MES -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">calendar_month</i>
                        </div>
                        <p class="card-category">VENTAS DEL MES (MTD)</p>
                        @if($ventasMesYearPasado != 0)
                        <h3 class="card-title">{{number_format(($ventasMes/$ventasMesYearPasado)*100, 2, ".", ",")}}%</h3>
                        @else
                        <h3 class="card-title">{{number_format(($ventasMes/1)*100, 2, ".", ",")}}%</h3>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <div class="col-6">
                            <h6>Anterior <p class="text-success">2021</p>
                            </h6>
                            <h5 class="text-success">${{number_format($ventasMesYearPasado, 2, ".", ",")}}</h5>
                        </div>
                        <div class="col-6">
                            <h6>Actual <p class="text-info">2022</p>
                            </h6>
                            <h5 class="text-info">${{number_format($ventasMes, 2, ".", ",")}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- VENTAS DEL Año -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <p class="card-category">VENTAS DEL AÑO (YTD)</p>
                        @if($ventasMesYearPasado != 0)
                        <h3 class="card-title">{{number_format(($ventasYear/($ventasYearPasado != 0 ? $ventasYearPasado : 1))*100, 2, ".", ",")}}%</h3>
                        @else
                        <h3 class="card-title">{{number_format(($ventasYear/($ventasYearPasado != 0 ? $ventasYearPasado : 1))*100, 2, ".", ",")}}%</h3>
                        @endif

                    </div>
                    <div class="card-footer text-center">
                        <div class="col-6">
                            <h6>Anterior</h6>
                            <h5 class="text-success">${{number_format($ventasYearPasado, 2, ".", ",")}}</h5>
                        </div>
                        <div class="col-6">
                            <h6>Actual</h6>
                            <h5 class="text-info">${{number_format($ventasYear, 2, ".", ",")}}</h5>
                        </div>
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
            <!-- CRECIMIENTO -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">trending_up</i>
                        </div>
                        <p class="card-category">VENTAS MES VS MES PASADO</p>
                        <h3 class="card-title">{{number_format($crecimiento, 2, ".", ",")}}%</h3>
                    </div>
                    <div class="card-footer">
                        <div class="col-6">
                            <h6>Anterior <p class="text-success">{{ $mesPasadoString->monthName }}</p>
                            </h6>
                            <h5 class="text-success">${{number_format($ventasTotalesHoyMesPasado, 2, ".", ",")}}</h5>
                        </div>
                        <div class="col-6">
                            <h6>Actual <p class="text-info">{{ $mesActualString->monthName }}</p>
                            </h6>
                            <h5 class="text-info">${{number_format($ventasMes, 2, ".", ",")}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- META DE CRECIMIENTO -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">flag</i>
                        </div>
                        <p class="card-category">META DE CRECIMIENTO 10% Mensual</p>
                        <h3 class="card-title">{{number_format($metaCrecimiento, 2, ".", ",")}}%</h3>
                    </div>
                    <div class="card-footer">
                        <div class="col-6">
                            <h6>Meta</h6>
                            <h5 class="text-success">${{number_format($ventasMesAnterior*1.10, 2, ".", ",")}}</h5>
                        </div>
                        <div class="col-6">
                            <h6>Actual</h6>
                            <h5 class="text-info">${{number_format($ventasMes, 2, ".", ",")}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- personas -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">groups</i>
                        </div>
                        <p class="card-category">Personas que entraron hoy</p>
                        <h3 class="card-title">{{ $personas->numero ?? 0 }}</h3>
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('PersonasDia') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="pwd">Numero de personas:</label>
                                <input type="number" class="form-control" id="pwd" name="numero">
                                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ date('Y-m-d') }}">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Grafica Mes -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ventas mes en curso vs mes año pasado</h4>
                    </div>
                    <div class="card-body">
                        <button id="downloadExcel2" class="btn btn-success">Descargar</button>
                        <div id="meses" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <!-- Grafica Year -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ventas año en curso vs año pasado</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('downloadYearInfo') }}" class="btn btn-success">Descargar</a>
                        <div id="year" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>
            </div>

            <!-- Factor de conversion -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Factor de conversion</h4>
                    </div>
                    <div class="card-body">
                        <div id="factor" style="height: 300px; width: 100%;"></div>
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
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
<script>
    var actual = <?php echo $ventasGrafica; ?>;
    var pasado = <?php echo $ventasPasadoGrafica; ?>;
    var meses = <?php echo $meses; ?>;
    var mtd = <?php echo $ventasMesGrafica; ?>;
    var mtdp = <?php echo $ventasMesPasadoGrafica; ?>;
    var dias = <?php echo $dias; ?>;
    var visitas = <?php echo $visitas; ?>;
    var contDocumentosMes = <?php echo $contDocumentosMes; ?>;
    console.log(contDocumentosMes);
    console.log(visitas);
</script>
<script type="text/javascript">
    window.onload = function() {

        var visitasArray = [];
        var personasCount = [];

        const formatter = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });

        function getDayOfWeek(date) {
            const dayOfWeek = new Date(date).getDay();
            return isNaN(dayOfWeek) ? null : ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'][dayOfWeek];
        }



        for (var i = 0; i < visitas.length; i++) {
            if (visitas[i].numero != 0) {
                visitasArray.push({
                    'label': getDayOfWeek(visitas[i].fecha) + ' ' + visitas[i].fecha,
                    'y': parseFloat((contDocumentosMes[i].contDocumentos / visitas[i].numero) * 100)
                });
                personasCount.push({
                    'label': getDayOfWeek(visitas[i].fecha) + ' ' + visitas[i].fecha,
                    'y': parseFloat(visitas[i].numero)
                });
            } else {
                visitasArray.push({
                    'label': getDayOfWeek(visitas[i].fecha),
                    'y': 0
                });
                personasCount.push({
                    'label': getDayOfWeek(visitas[i].fecha),
                    'y': 0
                });
            }

        }

        var mesActual = [];
        var mesPasado = [];

        for (var i = 1; i <= Object.keys(mtd).length; i++) {
            mesActual.push({
                'label': i,
                'y': parseFloat(mtd[i])
            });
        }
        for (var i = 1; i <= Object.keys(mtdp).length; i++) {
            mesPasado.push({
                'label': i,
                'y': parseFloat(mtdp[i])
            });
        }

        var chartMeses = new CanvasJS.Chart("meses", {
            axisX: {
                title: "Dias",
                titleFontSize: 20,
                interval: 1,
                labelFontSize: 15
            },
            axisY: {
                titleFontSize: 20,
                labelFontSize: 15
            },
            dataPointWidth: 15,
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeriesMeses
            },
            data: [{
                color: "#ff9d01",
                "name": "Actual",
                showInLegend: true,
                dataPoints: mesActual
            }, {
                color: "#009ece",
                "name": "Pasado",
                showInLegend: true,
                dataPoints: mesPasado
            }]
        });

        chartMeses.render();

        function toggleDataSeriesMeses(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chartMeses.render();
        }

        var dataPoints1 = [];
        var dataPoints2 = [];

        for (var i = 0; i < actual.length; i++) {
            dataPoints1.push({
                label: meses[i],
                y: parseFloat(actual[i])
            });
        }
        for (var i = 0; i < pasado.length; i++) {
            dataPoints2.push({
                'label': meses[i],
                'y': parseFloat(pasado[i])
            });
        }


        var yearChart = new CanvasJS.Chart("year", {
            exportEnabled: true,
            animationEnabled: true,
            axisX: {
                title: "Meses"
            },
            axisY: {
                title: "Actual",
                titleFontColor: "#4F81BC",
                lineColor: "#4F81BC",
                labelFontColor: "#4F81BC",
                tickColor: "#4F81BC",
                interval: 2000000,
                minimum: 3000000,
                maximum: 22000000
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeriesYear
            },
            data: [{
                color: "#ff9d01",
                type: "line",
                name: "Actual",
                showInLegend: true,
                dataPoints: dataPoints1
            }, {
                color: "#009ece",
                type: "line",
                name: "Pasado",
                showInLegend: true,
                dataPoints: dataPoints2
            }]
        });
        yearChart.render();

        function toggleDataSeriesYear(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            yearChart.render();
        }

        var chart = new CanvasJS.Chart("factor", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1",
            axisX: {
                labelAngle: 135
            },
            axisY: {
                title: "Factor de conversion",
                titleFontColor: "#4F81BC",
                lineColor: "#4F81BC",
                labelFontColor: "#4F81BC",
                tickColor: "#4F81BC"
            },
            axisY2: {
                title: "Numero de personas",
                titleFontColor: "#C0504E",
                lineColor: "#C0504E",
                labelFontColor: "#C0504E",
                tickColor: "#C0504E"
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                //itemclick: toggleDataSeries
            },
            data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    name: "Factor",
                    indexLabelFontSize: 16,
                    indexLabelPlacement: "outside",
                    dataPoints: visitasArray
                },
                {
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    axisYType: "secondary",
                    indexLabelFontColor: "#5A5757",
                    indexLabelFontSize: 16,
                    name: "Numero de personas",
                    indexLabelPlacement: "outside",
                    dataPoints: personasCount
                }
            ],
        });
        chart.render();

        document.getElementById("downloadExcel2").addEventListener("click", function() {
            downloadAsExcel({
                filename: "chart-data",
                chart: chartMeses
            })
        });

        function downloadAsExcel(args) {
            var dataPoints, filename;
            filename = args.filename || 'chart-data';

            dataPoints = args.chart.options.data[0].dataPoints;
            dataPoints1 = args.chart.options.data[1].dataPoints;
            dataPoints.unshift({
                x: "X Value",
                y: "Y-Value"
            });

            dataPoints1.unshift({
                x: "X Value",
                y: "Y-Value"
            });
            console.log(dataPoints);
            console.log(dataPoints1);

            var datos = new Array();
            for (var i = 0; i < dataPoints.length; i++) {

                datos[i] = {
                    'label': dataPoints[i].label,
                    'y': dataPoints[i].y,
                    'x': dataPoints1[i].y
                };
            }


            console.log(datos);

            var ws = XLSX.utils.json_to_sheet(datos, {
                skipHeader: true,
                dateNF: 'YYYYMMDD HH:mm:ss'
            });
            if (!ws['!cols']) ws['!cols'] = [];
            ws['!cols'][0] = {
                wch: 17
            };
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, filename);
            XLSX.writeFile(wb, filename + ".xlsx");
        }

    }
</script>
@endpush
@endsection