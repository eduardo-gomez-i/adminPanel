<?php

namespace App\Http\Controllers;

use App\Exports\EtiquetasExport;
use App\Models\Etiquetas;
use App\Models\Productos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class NuevosProductosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('role_index'), 403);
        return view('nuevos.index');
    }

    public function exportar(Request $request)
    {
        /*$hoy = Carbon::today()->toDateString();
        $datos = Productos::with('etiquetas')->whereBetween('fechaalta', [$request->fecha, $hoy])->get();
        $relacion = $datos->pluck('etiquetas');*/
        return Excel::download(new EtiquetasExport($request->fecha), 'productos.xlsx');
        //return view('nuevos.index');
    }
}
