<?php

namespace App\Http\Controllers;

use App\Models\Codbar;
use App\Models\Documentos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();
        //$hoy = "2020-01-18";
        $hora = date("H") - 1;

        $reporte = Codbar::where('created_at', "$hoy")
        ->orderby('estado', 'DESC')
        ->get();

        $reporte2 = Documentos::select('doc.DOCID', 'doc.HORA', 'desdoc.DOCID', 'doc.CLIENTEID', 'doc.FOLDIARIO', 'doc.EMISOR',  DB::raw('COUNT(desdoc.TOTAL) AS PART'))
        ->join('desdoc', 'doc.DOCID', '=', 'desdoc.DOCID')
        ->where('doc.FECHA', "$hoy")
        ->where(function ($q) {
            $q->where('doc.TIPO', 'F')
                ->orWhere('doc.TIPO', 'N');
        })
            ->orderby('doc.hora', 'DESC')
            ->groupBy('doc.FOLDIARIO')
            ->limit(15)
            ->with('clientes')
            ->get();

        $reporteF = $reporte->union($reporte2);
        $reporteF->all();

        $reporteF = $reporteF->unique('FOLDIARIO');

        $reporteF = $reporteF->reverse('estado');

        $reporteF->all();

        return view('almacen.index', compact('reporteF'));
    }
}
