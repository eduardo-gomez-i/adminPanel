<?php

namespace App\Http\Controllers;

use App\Models\Codbar;
use App\Models\Documentos;
use App\Models\Partidas;
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

        $mejorColaborador = Codbar::select('emisor', DB::raw('sum(documentos) as docs'))
            ->where('created_at', $hoy)
            ->where('estado', 0)
            ->groupBy('emisor')
            ->orderBy('docs', 'DESC')
            ->first();

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

        return view('almacen.index', compact('reporteF', 'mejorColaborador'));
    }

    public function registroAlmacen()
    {
        $hoy = Carbon::now()->toDateString();

        return view('almacen.create', compact('hoy'));
    }

    public function registroAlmacenPost(Request $request)
    {
        $hoy = Carbon::now()->toDateString();

        $cod_bar = $request['documento'];
        $usuario = $request['usuario'];
        $cod_bar = preg_replace("/[^0-9]/", "", $cod_bar);
        $documento = Codbar::where('FOLDIARIO', "$cod_bar")->first();

        $cliente = Documentos::where('FECHA', "$hoy")
            ->where('FOLDIARIO', "$cod_bar")
            ->with('clientes')
            ->first();

        if ($cliente) {

            if (!empty($cliente->clientes->NOMBRE)) {
                if ($cliente->clientes->NOMBRE) {
                    $clienteF = $cliente->clientes->NOMBRE;
                } else {
                    $clienteF = "VENTA DE MOSTRADOR";
                }
            } else {
                $clienteF = "VENTA DE MOSTRADOR";
            }

            $partidas = Partidas::where('FECHA', "$hoy")
                ->where('FOLDIARIO', "$cod_bar")
                ->count();

            $comision = $partidas * .10;

            $CodBar = new CodBar();

            if (isset($documento)) {
                $preestado = $documento->estado;
                $estado = CodBar::where('estado', "$preestado")->first();
            } else {
                $estado = 0;
            }

            if (!isset($estado->estado)) {

                $CodBar->FOLDIARIO = $cod_bar;
                $CodBar->CLIENTE = $clienteF;
                $CodBar->comision = $comision;
                $CodBar->emisor = $usuario;
                $CodBar->area = 'AL';
                $CodBar->partidas = $partidas;
                $CodBar->documentos = '1';
                $CodBar->estado = $estado;
                $CodBar->created_at = $hoy;

                $CodBar->save();
            } elseif ($estado->estado <= 1) {
                $CodBar = CodBar::where('FOLDIARIO', '=', "$documento->FOLDIARIO")->first();
                $CodBar->estado = ($CodBar->estado) + 1;
                $CodBar->save();
            }
        }

        return redirect()->route('almacen');
    }

    public function busquedaAlmacen(Request $request)
    {
        $hoy = Carbon::now()->toDateString();

        $documento = Codbar::where('FOLDIARIO', $request->folio)
            ->first();
        return view('almacen.busqueda', compact('documento'));
    }
}
