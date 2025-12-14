<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendancesExport implements FromCollection,  WithHeadings, WithStyles, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attendance::with('employee', 'employee.schedule')->get();
    }

     /**
     * Define los encabezados de las columnas.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Rut Colaborador',
            'Nombre',
            'Fecha',
            'Horario',
            'Hora de entrada',
            'Hora de salida',
            'Estado',
            'Horas trabajadas',
        ];
    }


    /**
     * Aplica estilos a las celdas.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Aplica un estilo a la primera fila (encabezados)
            1 => ['font' => ['bold' => true]],
            // Ajusta el ancho de las columnas automáticamente
            // Otras opciones de estilo se pueden aplicar según sea necesario
        ];
    }

    /**
     * Mapea los datos a las columnas.
     *
     * @param mixed $attendance
     * @return array
     */
    public function map($attendance): array
    {
        return [
            $attendance->id,
            $attendance->employee->employee_id,
            $attendance->employee->firstName. " ".$attendance->employee->lastName,
            $attendance->date,
            $attendance->employee->schedule ? $attendance->employee->schedule->time_in . ' - ' . $attendance->employee->schedule->time_out : '',
            $attendance->time_in,
            $attendance->time_out,
            $this->getStatusText($attendance->status),
            $attendance->num_hr,
        ];
    }

    /**
     * Retorna el texto del estado basado en el valor de status.
     *
     * @param int $status
     * @return string
     */
    private function getStatusText(int $status): string
    {
        switch ($status) {
            case 1:
                return 'A tiempo';
            case 2:
                return 'Atraso';
            default:
                return 'No especifica';
        }
    }

}
