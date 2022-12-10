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
        $hoy = Carbon::today();
        //$hoy = "2019-11-15";
        $usuario = auth()->user()->name;

        return view('cajas.index', [
            'hoy' => $hoy,
            'usuario' => $usuario,
        ]);
    }

    public function getEfectivoRemisiones(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }
        //$hoy = "2021-12-17";
        
        if ($request->caja == 1) {
            $efectivoRem = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'E')
            ->where('REFERENCIA', 'NOT')
            //->orderBY('HORA', 'desc')
            ->with('pagdoc.Documento', 'clientes')
            ->get();
        }else {
            $idUsuario = Personal::where('CATEGORIA', $request->caja)
            ->first();

            $efectivoRem = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'E')
            ->where('REFERENCIA', 'NOT')
            ->where('EMISORID', "$idUsuario->PERID")
            //->orderBY('HORA', 'desc')
            ->with('pagdoc.Documento', 'clientes')
            ->get();
        }

        return response()->json($efectivoRem);
    }

    public function getEfectivoFacturas(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }
        //$hoy = "2022-10-30";

        if ($request->caja == 1) {
            $efectivoFac = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'E')
            ->where('REFERENCIA', 'FAC')
            //-> orderBY('HORA', 'desc')
            ->with('pagdoc.Documento.cfd', 'clientes')
            ->get();
        }else {
            $idUsuario = Personal::where('CATEGORIA', $request->caja)
            ->first();

            $efectivoFac = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'E')
            ->where('REFERENCIA', 'FAC')
            //-> orderBY('HORA', 'desc')
            ->where('EMISORID', "$idUsuario->PERID")
            ->with('pagdoc.Documento.cfd', 'clientes')
            ->get();
        }

        return response()->json($efectivoFac);
    }

    public function getCredito(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        }else {
            $hoy = Carbon::today();
        }
        //$hoy = "2021-12-17";

            $creditos = Documentos::select('doc.DOCID', 'doc.CLIENTEID', 'cli.CLIENTEID', 'doc.NUMERO', 'doc.FECHA', 'doc.HORA', 'doc.TOTAL', 'doc.TOTALPAGADO',  DB::raw('TOTAL-TOTALPAGADO AS RESTANTE'))
            ->join('cli', 'doc.CLIENTEID', '=', 'cli.CLIENTEID')
            ->where('doc.fecha', "$hoy")
            ->where('doc.ESTADO', 'I')
            //->where('doc.COND', 'R')
            ->where(function ($q) {
                $q->where('doc.COND', 'R')
                    ->orWhere('doc.COND', 'C');
            })
            ->where(function ($q) {
                $q->where('doc.TIPO', 'F')
                    ->orWhere('doc.TIPO', 'N');
            })
            ->whereRaw('TOTAL-TOTALPAGADO > 0')
            //->where('doc.AFECTADOC', 'S')
            //->where('doc.TIPO', 'F')
            ->where('doc.VENCE', '>=', "$hoy")
                ->with('clientes')
            ->distinct('doc.DOCID')
            ->get();
        

        return response()->json($creditos);
    }

    public function getTarjetas(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }
        //$hoy = "2021-12-17";

        if ($request->caja == 1) {
            $tarjetas = Cajas::leftjoin('lista_forpag', 'caj.MOV', '=', 'lista_forpag.CLAVE')
            ->where('fecha',"$hoy")
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
            ->with('pagdoc.Documento.cfd', 'clientes')
            ->get();
        }else {
            $idUsuario = Personal::where('CATEGORIA', $request->caja)
            ->first();

            $tarjetas = Cajas::leftjoin('lista_forpag', 'caj.MOV', '=', 'lista_forpag.CLAVE')
            ->where('fecha', "$hoy")
            ->where(function ($q) {
                $q->where('MOV', 'B')
                    ->orWhere('MOV', '0')
                    ->orWhere('MOV', '2')
                    ->orWhere('MOV', '3')
                    ->orWhere('MOV', '4')
                    ->orWhere('MOV', '5')
                    ->orWhere('MOV', '6')
                    ->orWhere('MOV', '9')
                    ->orWhere('MOV', 'F')
                    ->orWhere('MOV', 'S')
                    ->orWhere('MOV', 'T')
                    ->orWhere('MOV', 'X')
                    ->orWhere('MOV', 'Y')
                    ->orWhere('MOV', 'Z');
            })
            ->where('EMISORID', "$idUsuario->PERID")
            ->with('pagdoc.Documento.cfd', 'clientes')
            ->get();
        }

        return response()->json($tarjetas);
    }

    public function getCheques(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }
        //$hoy = "2021-12-17";

        if ($request->caja == 1) {
            $cheques = Cajas::leftjoin('lista_forpag', 'caj.MOV', '=', 'lista_forpag.CLAVE')
            ->where('fecha',$hoy)
            ->where(function ($q) {
                $q->where('MOV', 'Q')
                    ->orWhere('MOV', 'C')
                    ->orWhere('MOV', 'R');
            })
            ->with('pagdoc.Documento', 'clientes')
            ->get();
        }else {
            $idUsuario = Personal::where('CATEGORIA', $request->caja)
            ->first();

            $cheques = Cajas::leftjoin('lista_forpag', 'caj.MOV', '=', 'lista_forpag.CLAVE')
            ->where('fecha', $hoy)
            ->where(function ($q) {
                $q->where('MOV', 'Q')
                    ->orWhere('MOV', 'C')
                    ->orWhere('MOV', 'R');
            })
            ->where('EMISORID', "$idUsuario->PERID")
            ->with('pagdoc.Documento', 'clientes')
            ->get();
        }


        return response()->json($cheques);
    }

    public function getInfonavit(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }
        //$hoy = "2021-12-13";
        if ($request->caja == 1) {
        $infonavit = Cajas::where('fecha', "$hoy")
        ->where('MOV', 'I')
            ->with('pagdoc.Documento', 'clientes')
            ->get();
        }else {
            $idUsuario = Personal::where('CATEGORIA', $request->caja)
            ->first();

            $infonavit = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'I')
            ->with('pagdoc.Documento', 'clientes')
            ->where('EMISORID', "$idUsuario->PERID")
            ->get();
        }

        return response()->json($infonavit);
    }

    public function getDepositos(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }
        //$hoy = "2021-08-25";
        if ($request->caja == 1) {
            $depositos = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'D')
                ->with('pagdoc.Documento', 'clientes')
                ->get();
        } else {
            $idUsuario = Personal::where('CATEGORIA', $request->caja)
                ->first();

            $depositos = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'D')
                ->with('pagdoc.Documento', 'clientes')
                ->where('EMISORID', "$idUsuario->PERID")
                ->get();
        }

        return response()->json($depositos);
    }

    public function getConekta(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }
        //$hoy = "2021-05-27";
        if ($request->caja == 1) {
            $conekta = Cajas::where('fecha', "$hoy")
            ->where('MOV', '1')
                ->with('pagdoc.Documento', 'clientes')
                ->get();
        } else {
            $idUsuario = Personal::where('CATEGORIA', $request->caja)
                ->first();

            $conekta = Cajas::where('fecha', "$hoy")
            ->where('MOV', '1')
                ->with('pagdoc.Documento', 'clientes')
                ->where('EMISORID', "$idUsuario->PERID")
                ->get();
        }

        return response()->json($conekta);
    }

    public function getLink(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }
        //$hoy = "2020-11-09";
        if ($request->caja == 1) {
            $conekta = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'M')
                ->with('pagdoc.Documento', 'clientes')
                ->get();
        } else {
            $idUsuario = Personal::where('CATEGORIA', $request->caja)
                ->first();

            $conekta = Cajas::where('fecha', "$hoy")
            ->where('MOV', 'M')
                ->with('pagdoc.Documento', 'clientes')
                ->where('EMISORID', "$idUsuario->PERID")
                ->get();
        }

        return response()->json($conekta);
    }

    public function getCancelados(Request $request)
    {
        if (isset($request->fecha)) {
            $hoy = $request->fecha;
        } else {
            $hoy = Carbon::today();
        }

        $canceladas = Documentos::where('FECHA', "$hoy")
            ->where(function ($q) {
                $q->where('ESTADO', 'C')
                    ->orWhere('ESTADO', 'R');
            })
            ->where(function ($q) {
                $q->where('TIPO', 'F')
                    ->orWhere('TIPO', 'N');
            })
            ->with('clientes')
            ->get();

        return response()->json($canceladas);
    }
}
