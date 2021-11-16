<?php

namespace App\Http\Controllers;

use App\Models\Cajas;
use App\Models\Documentos;
use App\Models\Partidas;
use App\Models\Personal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // FECHAS //
        $hoy = Carbon::today();
        $mes = Carbon::today()->month;
        $hoyMesPasado = Carbon::today()->subMonth();
        $mesAnterior = Carbon::today()->subMonth()->month;
        $year = Carbon::today()->year;
        $yearpasado = Carbon::today()->subYear()->year;

        // GRAFICAS //

        $ventasGrafica = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $ventasPasadoGrafica = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];


        $yearActualGrafica = Documentos::select(
            DB::raw('sum(TOTAL) as sums'),
            DB::raw("DATE_FORMAT(FECHA,'%m') as monthKey")
        )
        ->whereYear('FECHA', $year)
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
        ->groupBy('monthKey')
        ->orderBy('FECHA', 'ASC')
        ->get();

        $yearPasadoGrafica = Documentos::select(
            DB::raw('sum(TOTAL) as sums'),
            DB::raw("DATE_FORMAT(FECHA,'%m') as monthKey")
        )
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
        ->whereYear('FECHA', $yearpasado)
        ->groupBy('monthKey')
        ->orderBy('FECHA', 'ASC')
        ->get();

        foreach ($yearActualGrafica as $venta) {
            $ventasGrafica[$venta->monthKey - 1] = $venta->sums;
        }

        foreach ($yearPasadoGrafica as $venta) {
            $ventasPasadoGrafica[$venta->monthKey - 1] = $venta->sums;
        }
        $ventasGrafica = json_encode($ventasGrafica);
        $ventasPasadoGrafica = json_encode($ventasPasadoGrafica);

        // TARJETAS //

        $contPartidas = Partidas::where('FECHA', "$hoy")
        ->where(function ($q) {
            $q->where('TIPO',
                'F'
            )
            ->orWhere('TIPO', 'N');
        })
        ->count();

        $contDocumentos = Documentos::where('FECHA', "$hoy")
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
        ->count();

        $countCancelados = Documentos::where('FECHA', "$hoy")
        ->where('ESTADO', 'C')
        ->with('clientes')
        ->count();

        $ventasTotales = Documentos::where('FECHA', "$hoy")
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
        ->sum('TOTAL');

        if ($contDocumentos > 0) {
            $ticketPromedio = $ventasTotales / $contDocumentos;
        } else {
            $ticketPromedio = 0;
        }

        $ventasTotalesHoy = Documentos::where('FECHA', "$hoy")
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
            ->sum('TOTAL');

        $ventasMes = Documentos::whereMonth('FECHA', "$mes")
        ->whereYear('FECHA', "$year")
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
            ->sum('TOTAL');

        $ventasTotalesHoyMesPasado = Documentos::where('FECHA', "$hoyMesPasado")
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
            ->sum('TOTAL');

        if ($ventasTotalesHoyMesPasado > 0) {
            $crecimiento = (($ventasTotalesHoy / $ventasTotalesHoyMesPasado) - 1) * 100;
        } else {
            $crecimiento = 0;
        }

        $ventasMesAnterior = Documentos::whereMonth('FECHA', "$mesAnterior")
        ->whereYear('FECHA', "$year")
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
            ->sum('TOTAL');

        if ($ventasMesAnterior > 0) {
            $porcVentasMes = ($ventasMes  / $ventasMesAnterior) * 100;
            $metaCrecimiento = (($ventasMes  / $ventasMesAnterior) - 1) * 100;
        } else {
            $porcVentasMes = 100;
            $metaCrecimiento = 100;
        }

        // TABLAS //

        $documentosVendedor = Personal::select('NOMBRE')
        ->withCount(['Documentos AS documentos_sum' => function ($query) use ($hoy) {
            $query->select(DB::raw('SUM(TOTAL) as documentos_sum'))
            ->where(function ($q) {
                $q->where('doc.TIPO', 'F')
                    ->orWhere('doc.TIPO', 'N');
            })->where('doc.FECHA', "$hoy");
        },
        'Documentos' => function ($query) use ($hoy) {
            $query->where(function ($q) {
                $q->where('doc.TIPO', 'F')
                ->orWhere('doc.TIPO', 'N');
            })->where('doc.FECHA', "$hoy");
        }, 'Partidas' => function ($query) use ($hoy) {
            $query->where(function ($q) {
                $q->where('desdoc.TIPO', 'F')
                    ->orWhere('desdoc.TIPO', 'N');
            })->where('desdoc.FECHA', "$hoy");
        }])
        ->Validos()
        ->orderBy('documentos_sum', 'desc')
        ->get();

        $TopHoy = Personal::join('doc', 'per.CATEGORIA', '=', 'doc.EMISOR')
            ->select('per.NOMBRE', 'doc.EMISOR', DB::raw('SUM(doc.TOTAL) as TOTAL'))
            ->where('doc.FECHA', "$hoy")
            ->where(function ($q) {
                $q->where('doc.TIPO', 'F')
                ->orWhere('doc.TIPO', 'N');
            })
            ->groupBy('doc.EMISOR')
            ->orderBy('TOTAL', 'desc')
            ->limit(5)
            ->get();

        $TopMes = DB::connection('ferrum')->table('per')
        ->join('doc', 'per.CATEGORIA', '=', 'doc.EMISOR')
        ->select('per.NOMBRE', 'doc.EMISOR', DB::raw('SUM(doc.TOTAL) as TOTAL'))
        ->whereMonth('doc.FECHA', "$mes")
        ->where(function ($q) {
            $q->where('doc.TIPO', 'F')
            ->orWhere('doc.TIPO', 'N');
        })
            ->where('doc.ANTERIOR', '!=', 'GLOBAL')
        ->groupBy('doc.EMISOR')
        ->orderBy('TOTAL', 'desc')
        ->limit(5)
        ->get();

        $documentosRecientes = Cajas::where('FECHA', "$hoy")
        ->orderBy('HORA', 'desc')
        ->take(5)
        ->with('clientes')
        ->get();

        $canceladas = Documentos::where('FECHA', "$hoy")
        ->where('ESTADO', 'C')
        ->with('clientes')
        ->get();

        return view('home', compact(
            'documentosVendedor', 
            'TopHoy', 
            'TopMes',
            'documentosRecientes',
            'canceladas',
            'contPartidas',
            'contDocumentos',
            'countCancelados',
            'ticketPromedio',
            'ventasTotalesHoy',
            'ventasMes',
            'crecimiento',
            'metaCrecimiento',
            'yearActualGrafica',
            'ventasGrafica',
            'ventasPasadoGrafica'
            )
        );
    }
}
