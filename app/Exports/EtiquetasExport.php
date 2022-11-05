<?php

namespace App\Exports;

use App\Models\Productos;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EtiquetasExport implements FromCollection, WithHeadings
{
    protected $fecha;

    function __construct($fecha)
    {
        $this->fecha = $fecha;
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return ["CLAVE", "DESCRIPCION", "ALIAS", "CODIGO_PRODUCTO", "CODBAR", "CATEGORIA", "LINEA", "MARCA", "UNIDAD", "PUBLICO", "MEDIOMAYOREO", "MAYOREO", "MINIMO", "EXISTENCIAS", "MENUDEOMSI", "MEDIOMAYOREOMSI", "MAYOREOMSI", "MINIMOMSI", "METROCAJPUB", "METROCAJMED", "METROCAJMAY", "METROCAJMIN", "FECHA", "UBICACION"];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $hoy = Carbon::today()->toDateString();
        $datos = Productos::with('etiquetas')->whereBetween('fechaalta', [$this->fecha, $hoy])->get();
        $relacion = $datos->pluck('etiquetas');
        return $relacion;
    }
}
