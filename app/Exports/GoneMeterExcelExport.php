<?php

namespace App\Exports;

use App\Reconciliation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class GoneMeterExcelExport implements FromCollection, WithHeadings, WithEvents, WithStrictNullComparison
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
   
    public function collection()
    {
      
        return collect(Reconciliation::GoneExportRecord());
    }
    public function headings(): array
    {
        return [
        	'सि.न.',
            'खर्च भौचर बुझाएको मिति ',
            'परिमाण'
        ];
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
              //$event->sheet->setCellValue('')
            },
        ];
    }


}
