<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncentivosController extends Controller
{
    public function index(){
        $inicioSemana = Carbon::now()->startOfWeek()->format('Y-m-d');
        $finSemana = Carbon::now()->endOfWeek()->format('Y-m-d');
        $numeroDia = Carbon::now()->dayOfWeek;

        $asistencia = Asistencia::with('trabajador')->select(DB::raw('count(*) as dias_puntuales'), 'id_trabajador', 'hora_entrada', 'fecha')->whereBetween('fecha', [$inicioSemana, $finSemana])->groupBy('id_trabajador')->get();

        $puntualidadReporte = collect();
        $AsistenciaReporte = collect();

        foreach ($asistencia as $key => $personal) {
            if ($personal->hora_entrada <= '08:00:59') {
                $AsistenciaReporte->add([
                    'trabajador' => $personal->trabajador->nombre,
                    'bono' => 1,
                    'dias_puntuales' => $personal->dias_puntuales
            ]);
            } else {
                $AsistenciaReporte->add([
                    'trabajador' => $personal->trabajador->nombre,
                    'bono' => 0,
                    'dias_puntuales' => $personal->dias_puntuales
            ]);
            }
        }

        foreach ($AsistenciaReporte as $key => $personal) {
            if ($personal['dias_puntuales'] <= $numeroDia && $personal['bono'] == 1) {
                $puntualidadReporte[$key] = [
                    'trabajador' => $personal['trabajador'],
                    'bono' => 'si',
                ];
            } else {
                $puntualidadReporte[$key] = [
                    'trabajador' => $personal['trabajador'],
                    'bono' => 'no',
                ];
            }
        }

        return view('incentivos.index', compact('AsistenciaReporte', 'puntualidadReporte'));
    }
}
