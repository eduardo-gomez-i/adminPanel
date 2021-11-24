<?php

namespace App\Http\Controllers;

use App\Models\Cajas;
use App\Models\Documentos;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CajasController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today()->subDay();
        //$hoy = "2019-11-15";
        $usuario = auth()->user()->name;

        return view('cajas.index', [
            'hoy' => $hoy,
            'usuario' => $usuario,
        ]);
    }

    public function getEfectivoRemisiones(Request $request)
    {
        $hoy = Carbon::today();
        //$hoy = "2019-12-07";
        $usuario = auth()->user()->name;

        $efectivoRem = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'E')
            ->where('REFERENCIA', 'NOT')
            //->orderBY('HORA', 'desc')
            ->with('pagdoc.Documento', 'clientes')
            ->get();
        return response()->json($efectivoRem);
    }

    public function getEfectivoFacturas(Request $request)
    {
        $hoy = Carbon::today();
        //$hoy = "2019-12-07";
        $usuario = auth()->user()->name;

        $efectivoFac = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'E')
            ->where('REFERENCIA', 'FAC')
            //-> orderBY('HORA', 'desc')
            ->with('pagdoc.Documento', 'clientes')
            ->get();
        return response()->json($efectivoFac);
    }

    public function getCredito(Request $request)
    {
        $hoy = Carbon::today();
        //$hoy = "2019-12-07";

        $creditos = Documentos::select('doc.DOCID', 'doc.CLIENTEID', 'cli.CLIENTEID', 'doc.NUMERO', 'doc.FECHA', 'doc.HORA', 'doc.TOTAL', 'doc.TOTALPAGADO',  DB::raw('TOTAL-TOTALPAGADO AS RESTANTE'))
        ->join('cli', 'doc.CLIENTEID', '=', 'cli.CLIENTEID')
        ->where('doc.fecha', "$hoy")
        ->where('doc.ESTADO', 'I')
        ->where('doc.AFECTADOC', 'S')
        ->where('doc.TIPO', 'F')
        ->where('doc.TOTALPAGADO', '>', 0)
        ->where('doc.VENCE', '>=', "$hoy")
        //->orderBY('HORA', 'desc')
        ->with('clientes')
        ->get();
        return response()->json($creditos);
    }

    public function getTarjetas(Request $request)
    {
        $hoy = Carbon::today();
        //$hoy = "2019-12-07";

        $tarjetas = Cajas::where('fecha',
            "$hoy"
        )
        ->where(function ($q) {
            $q->where('MOV', 'B')
                ->orWhere('MOV', 'M')
                ->orWhere('MOV', 'S')
                ->orWhere('MOV', 'T')
                ->orWhere('MOV', 'W')
                ->orWhere('MOV', 'X')
                ->orWhere('MOV', 'Y')
                ->orWhere('MOV', 'Z');
        })
            //->orderBY('HORA', 'desc')
            ->with('pagdoc.Documento', 'clientes')
            ->get();
        return response()->json($tarjetas);
    }

    public function getCheques(Request $request)
    {
        $hoy = Carbon::today();
        //$hoy = "2019-12-07";

        $cheques = Cajas::where('fecha',$hoy)
        ->where(function ($q) {
            $q->where('MOV', 'Q')
                ->orWhere('MOV', 'C')
                ->orWhere('MOV', 'R');
        })
        ->with('pagdoc.Documento', 'clientes')
        ->get();

        return response()->json($cheques);
    }

    public function getInfonavit(Request $request)
    {
        $hoy = Carbon::today();

        $infonavit = Cajas::where('fecha', "$hoy")
        ->where('MOV', 'I')
            ->with('pagdoc.Documento', 'clientes')
            ->get();

        return response()->json($infonavit);
    }

    public function getCancelados(Request $request)
    {
        $hoy = Carbon::today();

        $canceladas = Documentos::where('FECHA', "$hoy")
        ->where(function ($q) {
            $q->where('ESTADO', 'C');
            //->orWhere('ESTADO', 'R');
        })
            ->where('AFECTADOC', 'S')
            ->with('clientes')
            ->get();

        return response()->json($canceladas);
    }
}
