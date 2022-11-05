<?php

namespace App\Http\Controllers;

use App\Models\Codbar;
use App\Models\Documentos;
use App\Models\Partidas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ComisionesController extends Controller
{
    public function vendedores()
    {
        $hoy = Carbon::today();
        $primerDia = Carbon::now()->startOfMonth();

        $comisiones = Documentos::select('per.NOMBRE', DB::raw('SUM(ORISUBTOTAL1 + ORISUBTOTAL2) AS SUBTOTAL0'), DB::raw('SUM((ORISUBTOTAL1 + ORISUBTOTAL2) *.0035) AS COMISION'))
        ->leftJoin('per', 'doc.VENDEDORID', '=', 'per.PERID')
        ->where(function ($q) {
                $q->where('doc.TIPO', 'F')
                    ->orWhere('doc.TIPO', 'N');
            })
        ->whereRaw("(INSTR(PER.CATEGORIA, 'EO')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'JV')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'C2')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'AD')=0)")
        ->whereBetween('doc.FECHA', [$primerDia, $hoy])
        ->groupBy('per.PERID')
        ->orderBy('per.NOMBRE')
        ->get();

        $comisionesTotales = Documentos::select(DB::raw('SUM(ORISUBTOTAL1 + ORISUBTOTAL2) AS SUBTOTAL0'), DB::raw('SUM((ORISUBTOTAL1 + ORISUBTOTAL2) *.0035) AS COMISION'))
        ->leftJoin('per', 'doc.VENDEDORID', '=', 'per.PERID')
        ->where(function ($q) {
            $q->where('doc.TIPO', 'F')
            ->orWhere('doc.TIPO', 'N');
        })
        ->whereRaw("(INSTR(PER.CATEGORIA, 'EO')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'JV')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'C2')=0)")
        ->whereRaw("(INSTR(PER.CATEGORIA, 'AD')=0)")
        ->whereBetween('doc.FECHA', [$primerDia, $hoy])
        ->first();

        return view('comisiones.index', compact('comisiones', 'comisionesTotales'));
    }
}
