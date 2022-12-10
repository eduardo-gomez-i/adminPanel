<?php

namespace App\Exports;

use App\Models\Documentos;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DocumentosExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'B' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'D' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'Fecha Pasado',
            'total Pasado',
            'Fecha Actual',
            'total Actual',
        ];
    }

    public function collection()
    {
        $year = Carbon::today()->year;
        $yeartodateEndOfMonth = Carbon::today()->endOfMonth()->subYear();

        $yearActualGrafica = Documentos::select(
            DB::raw('sum(TOTAL) as sums'),
            DB::raw('FECHA'),
        )
            ->whereYear('FECHA', $year)
            ->where(function ($q) {
                $q->where('TIPO', 'F')
                    ->orWhere('TIPO', 'N');
            })
            ->where('ANTERIOR', '!=', 'GLOBAL')
            ->groupBy('FECHA')
            ->orderBy('FECHA', 'ASC')
            ->get();

        $yearPasadoGrafica = Documentos::select(
            DB::raw('sum(TOTAL) as sums'),
            DB::raw("FECHA")
        )
            ->where(function ($q) {
                $q->where('TIPO', 'F')
                    ->orWhere('TIPO', 'N');
            })
            ->where('ANTERIOR', '!=', 'GLOBAL')
            ->whereBetween('FECHA', [date('Y-01-01', strtotime("-1 year")), Carbon::today()->subYear()])
            ->groupBy('FECHA')
            ->orderBy('FECHA', 'ASC')
            ->get();

        $final = collect();

        foreach ($yearPasadoGrafica as $key => $item) {
            if (isset($yearActualGrafica[$key])) {
                $final[$key] = [
                    'datePasado' => $item->FECHA,
                    'sumPasado' => $item->sums,
                    'dateActual' => $yearActualGrafica[$key]->FECHA,
                    'sumActual' => $yearActualGrafica[$key]->sums,
                ];
            } else {
                $final[$key] = [
                    'datePasado' => $item->FECHA,
                    'sumPasado' => $item->sums,
                    'dateActual' => '',
                    'sumActual' => '',
                ];
            }
        }

        return $final;
    }
}
