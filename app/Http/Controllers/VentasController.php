<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today()->subDay();
        //$hoy = '2021-08-27';

        $reporte = DB::connection('ferrum')->table('per')
        ->join('doc', 'per.CATEGORIA', '=', 'doc.EMISOR')
        ->select(
            'per.NOMBRE',
            'doc.EMISOR',
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=7
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a7am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=8
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a8am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=9
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a9am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=10
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a10am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=11
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a11am"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=12
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a12pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=13
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a13pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=14
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a14pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=15
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a15pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=16
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a16pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=17
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a17pm"),
            DB::raw("(SELECT COUNT(total) FROM doc 
	        WHERE doc.fecha='$hoy' AND HORA=18
            AND (doc.TIPO='F' OR doc.TIPO='N') AND doc.emisor = per.categoria) AS a18pm"),
            DB::raw('COUNT(doc.TOTAL) AS docTot'),
            DB::raw('SUM(doc.TOTAL) AS sumTot')
        )
            ->where('doc.FECHA', "$hoy")
            ->where(function ($query) {
                $query->where('doc.TIPO', '=', 'F')
                    ->orWhere('doc.TIPO', '=', 'N');
            })
            ->groupBy('per.CATEGORIA')
            ->orderBy('docTot', 'desc')
            ->get();


        $reporte2 = DB::connection('ferrum')->table('per')
        ->join('desdoc', 'per.CATEGORIA', '=', 'desdoc.EMISOR')
        ->select(
            'per.CATEGORIA',
            'desdoc.EMISOR',
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=7
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b7am"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=8
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b8am"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=9
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b9am"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=10
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b10am"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=11
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b11am"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=12
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b12pm"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=13
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b13pm"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=14
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b14pm"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=15
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b15pm"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=16
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b16pm"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=17
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b17pm"),
            DB::raw("(SELECT COUNT(DISTINCT DOCID) FROM desdoc 
	        WHERE desdoc.fecha='$hoy' AND HORA=18
            AND (desdoc.TIPO='F' OR desdoc.TIPO='N') AND desdoc.emisor = per.categoria) AS b18pm"),
            DB::raw('COUNT(DISTINCT desdoc.DOCID) AS parTot')
        )
            ->where('desdoc.FECHA', "$hoy")
            ->where(function ($query) {
                $query->where('desdoc.TIPO', '=', 'F')
                    ->orWhere('desdoc.TIPO', '=', 'N');
            })
            ->groupBy('per.CATEGORIA')
            ->orderBy('parTot', 'desc')
            ->get();


        //$personal = Per::query();

        return view('ventas.index', [
            'reporte' => $reporte,
            'reporte2' => $reporte2,
        ]);
    }
}
