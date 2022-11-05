<?php

namespace App\Http\Controllers;

use App\Models\Documentos;
use App\Models\Partidas;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();
        //$hoy = '2022-08-15';

        $contPartidas = Partidas::where('FECHA', "$hoy")
        ->where(function ($q) {
            $q->where(
                'TIPO',
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
        ->where(function ($q) {
            $q->where('ESTADO', 'C')
            ->orWhere('ESTADO', 'R');
        })
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->with('clientes')
        ->count();

        $ventasTotalesHoy = Documentos::where('FECHA', "$hoy")
        ->where(function ($q) {
            $q->where('TIPO', 'F')
            ->orWhere('TIPO', 'N');
        })
        ->where('ANTERIOR', '!=', 'GLOBAL')
            ->sum('TOTAL');
        //$hoy = '2021-08-27';

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

        $documentosVendedor = Personal::select('NOMBRE')
        ->withCount([
            'Documentos AS documentos_sum' => function ($query) use ($hoy) {
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
            }
        ])
        ->Validos()
        ->orderBy('documentos_sum', 'desc')
        ->get();

        
        foreach ($documentosVendedor as $key => $datos) {
            if ($datos->documentos_sum > 0) {
                $nombres[$key] = $datos->NOMBRE;
                $ventas[$key] = $datos->documentos_sum;
                $documentos[$key] = $datos->documentos_count;
                $partidas[$key] = $datos->partidas_count;
            }
        }

        $nombres= json_encode($nombres);
        $ventas = json_encode($ventas);
        $documentos = json_encode($documentos);
        $partidas = json_encode($partidas);

        $reporte = DB::connection('ferrum')->table('per')
        ->join('doc', 'per.PERID', '=', 'doc.VENDEDORID')
        ->select(
            'per.NOMBRE',
            'doc.EMISOR',
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=7
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a7am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=8
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a8am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=9
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a9am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=10
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a10am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=11
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a11am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=12
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a12pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=13
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a13pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=14
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a14pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=15
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a15pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=16
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a16pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=17
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a17pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=18
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.VENDEDORID = per.PERID) AS a18pm"),
            DB::raw('COUNT(doc.TOTAL) AS docTot'),
            DB::raw('SUM(doc.TOTAL) AS sumTot')
        )
            ->where('doc.FECHA', "$hoy")
            ->where(function ($query) {
                $query->where('doc.TIPO', '=', 'F')
                    ->orWhere('doc.TIPO', '=', 'N');
            })
            ->groupBy('per.CATEGORIA')
            ->orderBy('CATEGORIA', 'asc')
            ->get();


        $reporte2 = DB::connection('ferrum')->table('per')
        ->leftJoin('desdoc', 'per.PERID', '=', 'desdoc.VENDEDORID')
        ->select(
            'per.CATEGORIA',
            'desdoc.VENDEDORID',
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=7
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b7am"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=8
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b8am"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=9
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b9am"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=10
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b10am"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=11
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b11am"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=12
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b12pm"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=13
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b13pm"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=14
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b14pm"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=15
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b15pm"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=16
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b16pm"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=17
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b17pm"),
            DB::raw("(SELECT COUNT(DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=18
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.VENDEDORID = per.PERID) AS b18pm"),
            DB::raw('COUNT(desdoc.DOCID) AS parTot')
        )
            ->where('desdoc.FECHA', "$hoy")
            ->where(function ($query) {
                $query->where('desdoc.TIPO', '=', 'F')
                    ->orWhere('desdoc.TIPO', '=', 'N');
            })
            ->groupBy('per.CATEGORIA')
            ->orderBy('CATEGORIA', 'asc')
            ->get();

        $merged = $reporte->map(function ($item, $key) use ($reporte2) {
            //$reporte2 = (array) $reporte2;
            $item->NOMBRE = $item->NOMBRE;
            $item->EMISOR = $item->EMISOR;
            if ($item->a7am > 1) {
                $item->a7am = '<span class="text-primary">' . $item->a7am . '</span> | ' . $reporte2[$key]->b7am;
            }else {
                $item->a7am = '<span class="text-danger">' . $item->a7am . ' | ' . $reporte2[$key]->b7am. '</span>';
            }
            if ($item->a8am > 1) {
                $item->a8am = '<span class="text-primary">' . $item->a8am . '</span> | ' . $reporte2[$key]->b8am;
            }else {
                $item->a8am = '<span class="text-danger">' . $item->a8am . ' | ' . $reporte2[$key]->b8am. '</span>';
            }
            if ($item->a9am > 1) {
                $item->a9am = '<span class="text-primary">' . $item->a9am. '</span> | '. $reporte2[$key]->b9am;
            }else {
                $item->a9am = '<span class="text-danger">' . $item->a9am . ' | ' . $reporte2[$key]->b9am. '</span>';
            }
            if ($item->a10am > 1) {
                $item->a10am = '<span class="text-primary">' . $item->a10am. '</span> | '. $reporte2[$key]->b10am;
            }else {
                $item->a10am = '<span class="text-danger">' . $item->a10am . ' | ' . $reporte2[$key]->b10am. '</span>';
            }
            if ($item->a11am > 1) {
                # code...
                $item->a11am = '<span class="text-primary">' . $item->a11am . '</span> | ' . $reporte2[$key]->b11am;
            }else {
                # code...
                $item->a11am = '<span class="text-danger">' . $item->a11am.' | '. $reporte2[$key]->b11am. '</span>';
            }

            if ($item->a12pm > 1) {
                # code...
                $item->a12pm = '<span class="text-primary">' . $item->a12pm . '</span> | ' . $reporte2[$key]->b12pm;
            } else {
                # code...
                $item->a12pm = '<span class="text-danger">' . $item->a12pm . ' | ' . $reporte2[$key]->b12pm . '</span>';
            }

            if ($item->a13pm > 1) {
                # code...
                $item->a13pm = '<span class="text-primary">' . $item->a13pm . '</span> | ' . $reporte2[$key]->b13pm;
            } else {
                # code...
                $item->a13pm = '<span class="text-danger">' . $item->a13pm . ' | ' . $reporte2[$key]->b13pm . '</span>';
            }

            if ($item->a14pm > 1) {
                # code...
                $item->a14pm = '<span class="text-primary">' . $item->a14pm . '</span> | ' . $reporte2[$key]->b14pm;
            } else {
                # code...
                $item->a14pm = '<span class="text-danger">' . $item->a14pm . ' | ' . $reporte2[$key]->b14pm . '</span>';
            }

            if ($item->a15pm > 1) {
                # code...
                $item->a15pm = '<span class="text-primary">' . $item->a15pm . '</span> | ' . $reporte2[$key]->b15pm;
            } else {
                # code...
                $item->a15pm = '<span class="text-danger">' . $item->a15pm . ' | ' . $reporte2[$key]->b15pm . '</span>';
            }

            if ($item->a16pm > 1) {
                # code...
                $item->a16pm = '<span class="text-primary">' . $item->a16pm . '</span> | ' . $reporte2[$key]->b16pm;
            } else {
                # code...
                $item->a16pm = '<span class="text-danger">' . $item->a16pm . ' | ' . $reporte2[$key]->b16pm . '</span>';
            }

            if ($item->a17pm > 1) {
                # code...
                $item->a17pm = '<span class="text-primary">' . $item->a17pm . '</span> | ' . $reporte2[$key]->b17pm;
            } else {
                # code...
                $item->a17pm = '<span class="text-danger">' . $item->a17pm . ' | ' . $reporte2[$key]->b17pm . '</span>';
            }

            if ($item->a18pm > 1) {
                # code...
                $item->a18pm = '<span class="text-primary">' . $item->a18pm . '</span> | ' . $reporte2[$key]->b18pm;
            } else {
                # code...
                $item->a18pm = '<span class="text-danger">' . $item->a18pm . ' | ' . $reporte2[$key]->b18pm . '</span>';
            }
            $item->docTot = '<span class="text-primary">' . $item->docTot . ' | ' . $reporte2[$key]-> parTot . '</span>';
            
            return $item;
        });

        $reportesUnidos = $merged->sortByDesc('sumTot');

        return view('ventas.index', [
            'reportesUnidos' => $reportesUnidos,
            'ventasTotalesHoy' => $ventasTotalesHoy,
            'contPartidas' => $contPartidas,
            'contDocumentos' => $contDocumentos,
            'countCancelados' => $countCancelados,
            'ticketPromedio' => $ticketPromedio,
            'nombres' => $nombres,
            'ventas' => $ventas,
            'documentos' => $documentos,
            'partidas' => $partidas
        ]);
    }
}
