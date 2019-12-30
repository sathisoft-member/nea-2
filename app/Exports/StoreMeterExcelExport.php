<?php

namespace App\Exports;

use App\Reconciliation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StoreMeterExcelExport implements FromCollection, WithHeadings
{
    use Exportable;
    public function collection()
    {
      
        return collect(Reconciliation::StoreExportRecord());
    }
    public function headings(): array
    {
        return [
        	'सि.न.',
            'मिटर बुझेको मिति',
            'परिमाण'
        ];
    }
}
