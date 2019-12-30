<?php

namespace App\Exports;

use App\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    private $month;
    private $first_date;
    private $last_date;
    private $type;
    private $status;



    public function __construct($month = NUll, $first_date = NULL, $last_date = NULL, $type = NULL, $status = NULL)
    {
        $this->month = $month;
        $this->first_date = $first_date;
        $this->last_date = $last_date;
        $this->type = $type;
        $this->status = $status;
    }


    public function collection()
    {
        if ($this->type == 'month') {
            return collect(Registration::getRegistrationMonthly($this->month, $this->status));
        } else {
            return collect(Registration::getRegistrationRanging($this->first_date, $this->last_date, $this->status));
        }
    }
    public function headings(): array
    {
        return [
            'दरखास्त मिति',
            'दर्ता नं.',
            'निवेदकको नाम/थर',
            'ठेगाना',
            'ग्राहक वर्गीकरण',
            'फोन नं'
        ];
    }
}
